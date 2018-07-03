<?php
namespace App\Util;

use Cake\Core\Configure;
use Cake\Network\Http\Client;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use App\Model\Entity\Part;

$init = false;

/**
 * RedmineUtility
 */
class RedmineUtil
{
	/**
     *
	 * return: 
     *   $group['id'] or $group[0] ... group id
     *   $group['name'] or $group[1] ... group name
	 */
	public static function getGroup($part_id)
	{
		if(is_null($part_id)){
			Log::write('error', 'part_id is null');
			return null;
		}

		Log::write('debug', 'find part name for part_id = '.$part_id);

		$name = Part::getGroupName($part_id);	
		if(is_null($name)){
			Log::write('error', 'failed to find group with part_id = '.$part_id);
			return null;
		}

        $con = ConnectionManager::get('redmine');
		$results = $con->execute(
						'SELECT id,lastname as name FROM users WHERE type = :type AND lastname = :name',
						['type' => 'Group', 'name'=> $name]
					)->fetchAll('assoc');

		if(count($results) == 0){
			Log::write('error', 'failed to get group id of '.$name);
			return null;
		}	

		return $results[0];
	}

	public static function createUser($member, $password = null)
	{
		Log::write('debug', 'created user: '.$member->account);	

		if(is_null($password)){
			$password = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
		}
		$user = ['user' => [
					'login' => $member->account,
					'firstname' => $member->nickname,
					'lastname' => Part::getPartPrefix($member->part_id).'_',
					'mail' => $member->email,
					'password' => $password
				]];
		$user_json = json_encode($user);

		$ret = RedmineUtil::post('/users.json', $user_json);
		if($ret == false){
        	Log::write('error', 'failed to create redmine account: '.$user_json);
			return null;
		}

		Log::write('info', 'created user: '.$user_json);	
		return RedmineUtil::findUser($member->account);
	}

	/**
	 * $account ... login account of redmine (ex. CB_AKIRA)
	 * return:
	 *  $user
			$user['id']
			$user['login']
			$user['firstname']
			$user['lastname']
			$user['mail']
			$user['create_on']
			$user['last_login_on']
  	 */
    public static function findUser($account)
    {
		if(is_null($account)){
        	Log::write('error', 'findUser: account is null');
			return;
		}
		/*
			URL: /users.json
			Response JSON:
   			{"users":[
      			{
         			"id":22,
         			"login":"CB_AKIRA",
         			"firstname":"\u30a2\u30ad\u30e9",
         			"lastname":"CB_",
         			"mail":"gkusumoto@gmail.com",
         			"created_on":"2013-03-11T17:41:59Z",
         			"last_login_on":"2018-06-01T23:29:12Z"
      			},
				:
		*/

        Log::write('info', 'findUser account='.$account);

		// status ... 1=active, 2=registering, 3=locked
		$json = RedmineUtil::get('users.json?name='.$account);
		if(is_null($json)){
			return null;
		}

		foreach($json['users'] as $user){
			//Log::write('debug', 'user : '.implode(" ",$user));
			if(strcmp($account, $user['login']) == 0){
				Log::write('info', 'user found: '.implode(",", $user));
				return $user;
			}	
		}	

		// when user is not found with status=1, re-find with status=3
		$json = RedmineUtil::get('users.json?name='.$account.'&status=3');
		if(is_null($json)){
			return null;
		}
		foreach($json['users'] as $user){
			//Log::write('debug', 'user : '.implode(" ",$user));
			if(strcmp($account, $user['login']) == 0){
				Log::write('info', 'user found (locked user): '.implode(",", $user));
				return $user;
			}	
		}

		Log::write('info', 'user not found: '.$account);
		return null;
    }

	/**
	 *
	 * Return JSON Example:
	 *  {
	 *     "groups":[
     * 		{"id":30,"name":"\u4ed6"},
	 *      {"id":29,"name":"\u5408\u5531"},
	 *      {"id":27,"name":"\u5f26\u697d\u5668"},
	 *      {"id":28,"name":"\u7ba1\u697d\u5668"}
	 *    ]
	 *  }
	 */
	public static function getAllGroups()
	{
        Log::write('info', 'getAllGroups');
		
		$json = RedmineUtil::get('/groups.json');
		return $json;		
	}

	/**
	 *
	 * $id .. redmine user id
	 */
	public static function disableNotification($id)
	{
		if(is_null($id)){
        	Log::write('error', 'disableNotification: id is null');
			return;
		}

        Log::write('info', 'disableNotification id='.$id);

		$ret = RedmineUtil::put('/users/'.$id.'.json', '{"user":{"id":'.$id.',"mail_notification":"none"}}');
		if($ret == false){
        	Log::write('error', 'failed to disableNotification: id='.$id);
		}
		return $ret;
	}

	public static function enableNotification($id)
	{
		if(is_null($id)){
        	Log::write('error', 'enableNotification: id is null');
			return;
		}

        Log::write('info', 'enableNotification id='.$id);
		Log::write('info', '/users/'.$id.'.json -> {"user":{"id":'.$id.',"mail_notification":"only_my_events"}}');

		$ret = RedmineUtil::put('/users/'.$id.'.json', '{"user":{"id":'.$id.',"mail_notification":"only_my_events"}}');
		if($ret == false){
        	Log::write('error', 'failed to enableNotification: id='.$id);
		}
		return $ret;
	}

	/**
	 *
	 * REST API Example:
	 *  # curl -X DELETE -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" -H 'Content-type: application/json' 
	 *     "http://localhost/redmine/groups/28/users/197.json"
	 */
	public static function unsetAllGroups($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'unsetAllGroups: user_id is null');
			return false;
		}

       	Log::write('info', 'unsetAllGroups: user_id='.$user_id);

		$groups_json = RedmineUtil::getAllGroups();
		foreach($groups_json['groups'] as $group_json){
			$ret = RedmineUtil::delete('/groups/'.$group_json['id'].'/users/'.$user_id.'.json');
			if($ret == false){
				Log::write('error', 'failed to unset user_id='.$user_id.' from '.$group_json['id']);
			}
		}

		return true;
	}

	/**
	 *
	 * REST API Example:
	 *  # curl -X POST -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" -H 'Content-type: application/json' 
	 *    -d '{"user_id":197}' "http://localhost/redmine/groups/28/users.json"
	 */
	public static function setGroup($user_id, $group_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'setGroup: user_id is null');
			return false;
		}
		if(is_null($group_id)){
        	Log::write('error', 'setGroup: group_id is null');
			return false;
		}

       	Log::write('info', 'setGroup: user_id='.$user_id.' to group_id='.$group_id);

		$ret = RedmineUtil::post('/groups/'.$group_id.'/users.json', '{"user_id":'.$user_id.'}');
		if($ret == false){
        	Log::write('error', 'failed to set group: user_id='.$user_id.' to group_id='.$group_id);
		}

		return $ret;
	}
	
	/**
		Response JSON Sample:
		{"projects":[
			{
				"id":1,
				"name":"Thanks! K Orchestra",
				"identifier":"thanks_k",
				"description":"............",
				"created_on":"2013-02-01T05:20:21Z",
				"updated_on":"2016-02-01T03:52:31Z"
			},
			{
				"id":8,
				"name":"K\u30aa\u30b1\u904b\u55b6",
				"identifier":"thanks_k_manage",
				"description":".........",
				"created_on":"2016-02-23T06:15:33Z",
				"updated_on":"2016-02-23T18:48:00Z"
			},
			{
				"id":10,
				"name":"\u6f14\u51fa\u90e8\uff06\u904b\u55b6",
				"identifier":"thanks_k_enshutsu",
				"description":"..........",
				"parent":{
					"id":8,
					"name":"K\u30aa\u30b1\u904b\u55b6"
				},
				"created_on":"2018-04-25T16:00:05Z",
				"updated_on":"2018-04-25T22:09:35Z"
			},
				:
				:
		],"total_count":7,"offset":0,"limit":25}
	*/
	public static function getAllProjects()
	{
        $json = RedmineUtil::get('/projects.json');
        return $json;
	}

	public static function getProject($name)
	{
		if(is_null($name)){
        	Log::write('error', 'getProject: name is null');
			return null;
		}

		Log::write('info', 'get project: name='.$name);

		$projects = RedmineUtil::getAllProjects();	
		foreach($projects['projects'] as $project){
			if(strcmp($project['name'], $name) == 0){
				return $project;
			}
		}

		Log::write('error', 'project '.$name.' is not found');
		return null;
	}

	/**
     *
     * Redmine API Example:
     *  # curl -X POST -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" -H 'Content-type: application/json' -d '{"membership":{"user_id":197,"role_ids":[4]}}' "http://localhost/redmine/projects/4/memberships.json"
     */
	public static function setProject($user_id, $project_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'setProject: user_id is null');
			return false;
		}
		if(is_null($project_id)){
        	Log::write('error', 'setProject: project_id is null');
			return false;
		}

		Log::write('info', 'set project: user_id='.$user_id.' project_id='.$project_id);
		
		$role_id = 4; // メンバー
		$ret = RedmineUtil::post('/projects/'.$project_id.'/memberships.json', '{"membership":{"user_id":'.$user_id.',"role_ids":['.$role_id.']}}');
		if($ret == false){
        	Log::write('error', 'failed to set project: user_id='.$user_id.' to project_id='.$project_id);
		}

		return $ret;
	}

	/**
     *
     * Redmine API Example:
     *  # curl -X POST -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" -H 'Content-type: application/json' 
	 *     -d '{"membership":{"user_id":197,"role_ids":[4]}}' "http://localhost/redmine/projects/4/memberships.json"
     */
	public static function setDefaultProjects($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'setDefaultProjects: user_id is null');
			return false;
		}

		Log::write('info', 'set default projects: user_id='.$user_id);

		$role_id = 4; // メンバー

		$default_project_names = Configure::read('Redmine.project.defaults');

		$projects = RedmineUtil::getAllProjects();	
		foreach($projects['projects'] as $project){
			if(in_array($project['name'], $default_project_names)){
				Log::write('info', 'add user_id='.$user_id.' to project_id='.$project['id']);
				
				$ret = RedmineUtil::post('/projects/'.$project['id'].'/memberships.json', '{"membership":{"user_id":'.$user_id.',"role_ids":['.$role_id.']}}');
				if($ret == false){
        			Log::write('error', 'failed to set project: user_id='.$user_id.' to project_id='.$project['id']);
				}
			}
		}

		return true;
	}

	public static function getMembershipsByUser($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'getMembershipsByUser: user_id is null');
			return false;
		}

       	Log::write('debug', 'getMembershipsByUser: user_id='.$user_id);

		$user = RedmineUtil::get('/users/'.$user_id.'.json?include=memberships');
		if(is_null($user)){
       		Log::write('error', 'getMembershipsByUser: failed to get user_id='.$user_id);
			return null;
		}
		
		return $user['user']['memberships'];
	}

	public static function unsetAllProjects($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'unsetAllProjects: user_id is null');
			return false;
		}

       	Log::write('info', 'unsetAllProjects: user_id='.$user_id);

		$memberships = RedmineUtil::getMembershipsByUser($user_id);	
		if(is_null($memberships)){
			return false;
		}

		$result = true;
		foreach($memberships as $membership){
			Log::write('debug', 'DELETE /memberships/'.$membership['id'].'.json');
			$ret = RedmineUtil::delete('/memberships/'.$membership['id'].'.json');
			if($ret == false){
				Log::write('error', 'failed to unset user_id='.$user_id.' from '.$membership['project']['name']);
				$result = false;
			}
		}

		return $result;
	}

	/**
     * curl -X PUT -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" -H "Content-type: application/json" -d '{"user":{"status":3}}' "http://localhost/redmine/users/208.json"
     *
     */
	public static function lockUser($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'lockUser: user_id is null');
			return false;
		}

        Log::write('info', 'lockUser user_id='.$user_id);

		$ret = RedmineUtil::put('/users/'.$user_id.'.json', '{"user":{"status":3}}');
		if($ret == false){
        	Log::write('error', 'failed to lock user: user_id='.$user_id);
		}
		return $ret;
	}

	public static function unlockUser($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'unlockUser: user_id is null');
			return false;
		}

        Log::write('info', 'unlockUser user_id='.$user_id);

		$ret = RedmineUtil::put('/users/'.$user_id.'.json', '{"user":{"status":1}}');
		if($ret == false){
        	Log::write('error', 'failed to unlock user: user_id='.$user_id);
		}
		return $ret;
	}

/*

mysql> select id, user_id, hide_mail, time_zone from user_preferences where user_id = 200; 
+-----+---------+-----------+-----------+
| id  | user_id | hide_mail | time_zone |
+-----+---------+-----------+-----------+
| 194 |     200 |         1 | Tokyo     |
+-----+---------+-----------+-----------+
1 row in set (0.00 sec)

hide_mail => 1  (メールアドレスを隠す)
time_zone => Tokyo
other => :no_self_notified: true (自分自身による変更の通知は不要)

*/

	public static function hideMailAddress($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'hideMailAddress: user_id is null');
			return false;
		}

		$con = ConnectionManager::get('redmine');
		$con->update('user_preferences', ['hide_mail' => 1], ['user_id' => $user_id]);

		Log::write('info', 'hide mailaddress of user_id='.$user_id);
		return true;
	}

	public static function setTimezone($user_id, $timezone)
	{
		if(is_null($user_id)){
        	Log::write('error', 'setTimezone: user_id is null');
			return false;
		}
		if(is_null($timezone)){
        	Log::write('error', 'setTimezone: timezone is null');
			return false;
		}

		$con = ConnectionManager::get('redmine');
		$con->update('user_preferences', ['time_zone' => $timezone], ['user_id' => $user_id]);

		Log::write('info', 'set timezone of user_id='.$user_id.' to '.$timezone);
		return true;
	}

	public static function setNoSelfNotified($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'setNoSelfNotified: user_id is null');
			return false;
		}
		
		$con = ConnectionManager::get('redmine');
		$results = $con->execute('SELECT others FROM user_preferences WHERE user_id = :user_id', ['user_id' => $user_id])
					   ->fetchAll('assoc');
		if(count($results) == 0){
			Log::write('error', 'setNoSelfNotified: no user_preferences record of user_id='.$user_id);
			return false;
		}	
		$user_preference = $results[0];	
		
		$revalue = "";
		foreach(explode("\n", $user_preference['others']) as $param){
			if(strpos($param, ':no_self_notified:') === 0){
				$param = ':no_self_notified: true';
			}
			$revalue .= $param . "\n";
		}

		$con->update('user_preferences', ['others' => $revalue], ['user_id' => $user_id]);

		Log::write('info', 'set no_self_notified:true of user_id='.$user_id);
		return true;
	}

    /**
     *
     * @param project_id ... project id (set null you want to get all events of all projects)
     * @param owner_id ... owner id (set null you don't want to specify owner)
     * @return 
     *    array (
     *      array (
     *        'id'
     *        'project_id'
     *        'event_owner_id'
     *        'event_subject'
     *        'event_date'
     *        'event_place_station'
     *        'event_place'
     *        'event_caption'
     *        'created_on'
     *      )
     *    )
     */
	public static function getFetureEvents($project_id = null, $owner_id = null)
	{
		$where = "";
		if(!is_null($project_id)){
			$where = " AND project_id = '".$project_id."'";
		}
		if(!is_null($owner_id)){
			$where = " AND even_owner_id = '".$owner_id."'";
		}

		$con = ConnectionManager::get('redmine');
		$results = $con->execute("SELECT id, project_id, event_owner_id, event_subject, DATE_FORMAT(event_date, '%Y-%m-%d') AS event_date,".
                                 " event_place_station, event_place, event_caption, created_on".
                                 " FROM event_models WHERE event_date > CURRENT_DATE()".$where)->fetchAll('assoc');
		
		return $results;
	}

	/**
     * REST API Example:
	 *  curl -H "X-Redmine-API-Key:9eb904a54d08a2dfbb6bde8658f4864b39f039ac" "http://localhost/redmine/users/22.json"
     * return	$user
			$user['id']
			$user['login']
			$user['firstname']
			$user['lastname']
			$user['mail']
			$user['create_on']
			$user['last_login_on']
	 */
	public static function getUser($user_id)
	{
		if(is_null($user_id)){
        	Log::write('error', 'getUser: user_id is null');
			return false;
		}

		$user = RedmineUtil::get('/users/'.$user_id.'.json');
		if(is_null($user)){
       		Log::write('error', 'getUser: failed to get user_id='.$user_id);
			return null;
		}

		return $user['user'];
	}

	// =====================================================
	//   row methods
	// =====================================================

	/**
     * for only json (http://localhost/redmine/**.json)
     */
	public static function get($path)
	{
		if(strpos($path, '/') !== 0){
			$path = '/'.$path;
		}

		$http = new Client();
		$response = $http->get(Configure::read('Redmine.api.url').$path, [],
							['headers' => [Configure::read('Redmine.api.header') => Configure::read('Redmine.api.key')]]
						);
		if(is_null($response) || $response->isOk() == false){
			return null;
		}	
		return $response->json;
	}

	public static function put($path, $json)
	{
		if(strpos($path, '/') !== 0){
			$path = '/'.$path;
		}

		$http = new Client();
	    $response = $http->put(Configure::read('Redmine.api.url').$path, $json,
                             ['headers' => [Configure::read('Redmine.api.header') => Configure::read('Redmine.api.key'),
											'Content-Type' => 'application/json']]
                         );
		return is_null($response)? false: $response->isOk();
	}

	public static function post($path, $json)
	{
		if(strpos($path, '/') !== 0){
			$path = '/'.$path;
		}
		Log::write('debug', $path.' '.$json);

		$http = new Client();
	    $response = $http->post(Configure::read('Redmine.api.url').$path, $json,
                             ['headers' => [Configure::read('Redmine.api.header') => Configure::read('Redmine.api.key'),
											'Content-Type' => 'application/json']]
                         );
		return is_null($response)? false: $response->isOk();
	}

	public static function delete($path)
	{
		if(strpos($path, '/') !== 0){
			$path = '/'.$path;
		}

		$http = new Client();
		$response = $http->delete(Configure::read('Redmine.api.url').$path, [],
							['headers' => [Configure::read('Redmine.api.header') => Configure::read('Redmine.api.key')]]
						);
		return is_null($response)? false: $response->isOk();
	}
}
?>
