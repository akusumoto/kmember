<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Status;
use App\Model\Entity\Activity;
use App\Model\Entity\Part;
use App\Util\MembersUtil;
use App\Util\RedmineUtil;
use App\Util\PostfixUtil;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Network\Email\Email;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 */
class MembersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['join', 'success', 'rule']);
    }

    public function rule()
    {
        $this->layout = 'public';
        $rule = $this->Settings->findByName('member.rule')->first()->value;
        $this->set('rule', $rule);
        $this->set('_serialize', ['rule']);
    }

    public function top()
    {
        $this->paginate = [
            'contain' => ['Parts', 'MemberTypes', 'Statuses']
        ];
        $this->set('members', 
            $this->paginate(
                $this->Members->find()
                              ->order(['Members.status_id' => 'ASC'])
                              ->order(['Members.part_id' => 'ASC'])
        ));
        $this->set('_serialize', ['members']);
    }

    /**
     * Detail method
     *
     * @param string|null $id Member id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function detail($id = null)
    {
        $this->view($id);
    }

    private function checkAuth()
    {
        $password = $this->Settings->findByName('member.join.password')->first()->value;
        if (isset($this->request->data['password'])){
            if ($this->request->data['password'] === $password) {
                $this->set('hash', md5($password));
                return true;
            }
            else {
                return false;
            }
        }

        if (isset($this->request->data['hash'])) {
            if ($this->request->data['hash'] === md5($password)) {
                $this->set('hash', md5($password));
                return true;
            } else {
                return false;
            }
        }
    
        return false;
    }

    public function success()
    {
        $this->layout = 'public';
    }

	public function createRedmineUser($member, $password)
	{
		$result_msg = "";

		$rm_user = null;
		$rm_user = RedmineUtil::createUser($member, $password);
		$result_msg .= __("Creating Redmine user ({0}) ... ", [$member->account]);
		if(is_null($rm_user)){
			$result_msg .= __("NG")."\n"; // failed to create redmine user
		}
		else {
			$result_msg .= __("OK")."\n"; // redmine user was created

			# attach project
			$default_project_names = Configure::read('Redmine.project.defaults');
			$result_msg .= __("Attach projects:")."\n";
			foreach($default_project_names as $project_name){
				$rm_project = RedmineUtil::getProject($project_name);
				if(is_null($rm_project)){
					continue;
				}

				$result_msg .= " - ".$rm_project['name']." ... ";
				if(RedmineUtil::setProject($rm_user['id'], $rm_project['id'])){
					$result_msg .= __("OK")."\n";
				}
				else {
					$result_msg .= __("NG")."\n";
				}
			}

			// attach group
			$rm_group = RedmineUtil::getGroup($member->part_id);
			$result_msg .= __("Assign group ({0}) ... ", [$rm_group['name']]);
			if(RedmineUtil::setGroup($rm_user['id'], $rm_group['id'])){
				$result_msg .= __("OK")."\n";
			}
			else{
				$result_msg .= __("NG")."\n";
			}

			// set hideMailAddress is on 
			$result_msg .= __("Enable 'hide mail address' ... ");
			if(RedmineUtil::hideMailAddress($rm_user['id'])){
				$result_msg .= __("OK")."\n";
			}
			else{
				$result_msg .= __("NG")."\n";
			}

			// set timezone to tokyo
			$result_msg .= __("Set timezone to {0} ... ", ["Asia/Tokyo"]);
			if(RedmineUtil::setTimezone($rm_user['id'], 'Tokyo')){
				$result_msg .= __("OK")."\n";
			}
			else{
				$result_msg .= __("NG")."\n";
			}

			// Set self notified is off
			$result_msg .= __("Set self notified is off ... ");
			if(RedmineUtil::setNoSelfNotified($rm_user['id'])){
				$result_msg .= __("OK")."\n";
			}
			else{
				$result_msg .= __("NG")."\n";
			}
		}
		
		return $result_msg;
	}

	public function setupRedmineUserForRejoin($member)
	{
		$msg = "";

		# emai of redmine may be changed by user.
		$output = PostfixUtil::unstopMail($member->email);
		$msg .= ' '.$output;
		
		# get redmine account information
		$rm_user = RedmineUtil::findUser($member->account);

		if(is_null($rm_user)){
			$msg .= ' Not found redmine account: '.$member->account;
		}
		else{
			if(strcmp($rm_user['mail'], $member->email) != 0){
				# emai of redmine may be changed by user.
				$output = PostfixUtil::unstopMail($rm_user['mail']);
				$msg .= ' '.$output;
			}

			if(RedmineUtil::enableNotification($rm_user['id'])){
				$msg .= ' Enableed mail notification.';
			}
			else{
				$msg .= ' Failed to enable mail notification.';
			}

			$rm_group = RedmineUtil::getGroup($member->part_id);
			if(RedmineUtil::setGroup($rm_user['id'], $rm_group['id'])){
				$msg .= ' set group '.$rm_group['name'].".";
			}
			else{
				$msg .= ' Failed to set group '.$rm_group['name'].".";
			}

			if(RedmineUtil::setNoSelfNotified($rm_user['id'])){
				// no message
			}
			else{
				$msg .= ' Failed to no_self_notified.';
			}

			if(RedmineUtil::unlockUser($rm_user['id'])){
				// no message
			}
			else{
				$msg .= ' Failed to unlock user.';
			}
		}

		return $msg;
	}

	public function setupRedmineUserForTempLeave($member)
	{
		$msg = "";

		# emai of redmine may be changed by user.
		$output = PostfixUtil::stopMail($member->email);
		$msg .= ' '.$output;

		# get redmine account information
		$rm_user = RedmineUtil::findUser($member->account);
		if(is_null($rm_user)){
			$msg .= ' Not found redmine account('.$member->account.'), then plase change redmine setting manually.';
		}
		else{
			if(strcmp($rm_user['mail'], $member->email) != 0){
				# emai of redmine may be changed by user.
				$output = PostfixUtil::stopMail($rm_user['mail']);
				$msg .= ' '.$output;
			}

			if(RedmineUtil::disableNotification($rm_user['id'])){
				$msg .= ' Disabled mail notification.';
			}
			else{
				$msg .= ' Failed to disable mail notification.';
			}

			if(RedmineUtil::unsetAllGroups($rm_user['id'])){
				$msg .= ' Unset from all groups.';
			}
			else{
				$msg .= ' Failed to unset groups.';
			}
		}
		
		return $msg;
	}

	public function setupRedmineUserForLeave($member)
	{
		$msg = "";

		# emai of redmine may be changed by user.
		$output = PostfixUtil::stopMail($member->email);
		$msg .= ' '.$output;

		# get redmine account information
		$rm_user = RedmineUtil::findUser($member->account);
		if(is_null($rm_user)){
			$msg .= ' Not found redmine account: '.$member->account;
		}
		else{
			if(strcmp($rm_user['mail'], $member->email) != 0){
				# emai of redmine may be changed by user.
				$output = PostfixUtil::stopMail($rm_user['mail']);
				$msg .= ' '.$output;

			}

			if(RedmineUtil::disableNotification($rm_user['id'])){
				$msg .= ' Disabled mail notification.';
			}
			else{
				$msg .= ' Failed to disable mail notification.';
			}

			if(RedmineUtil::unsetAllGroups($rm_user['id'])){
				$msg .= ' Unset from all groups.';
			}
			else{
				$msg .= ' Failed to unset groups.';
			}

			if(RedmineUtil::unsetAllProjects($rm_user['id'])){
				$msg .= ' Unset from all projects.';
			}
			else{
				$msg .= ' Failed to unset some projects.';
			}

			if(RedmineUtil::lockUser($rm_user['id'])){
				$msg .= ' Locked the user.';
			}
			else{
				$msg .= ' Failed to lock the user.';
			}
		}

		return $msg;
	}

	public function checkRedmineFeatureEvent($project_name)
	{
		$result_msg = "";
		$rm_project = RedmineUtil::getProject($project_name);
		$rm_events = RedmineUtil::getFetureEvents($rm_project['id']);

		foreach($rm_events as $rm_event){
			if(strlen($result_msg) == 0){
				$result_msg .= "\n\n";
				$result_msg .= __('There are following events in the future.')."\n";
				$result_msg .= __('Could you ask each owner to add the new member to the events.')."\n\n";
			}

			$rm_user = RedmineUtil::getUser($rm_event['event_owner_id']);
            // ex
			//  - 2018-04-01 合奏#1 (作成：アキラ)
			$result_msg .= '- '.$rm_event['event_date'].' '.$rm_event['event_subject'].
							' ('.__('owner:').$rm_user['firstname'].')'."\n";
		}

		return $result_msg;
	}

    /**
     * page flow:
     *  join ... input member information
     *   |
     *  join_confirm ... confirm input
     *   |
     *  join_success ... thank you page
     */
    public function join()
    {
        $this->layout = 'public';
        $member = $this->Members->newEntity();
        Log::write('debug', $this->request->data);
        if ($this->request->is('post')) {
            // post
            //Log::write('debug', 'join: POST');
            if ($this->checkAuth()) {
                if (isset($this->request->data['action'])) {
                    // 3. save member info & success page [no 
                    $member = $this->Members->patchEntity($member, $this->request->data);
                    $member->status_id = $this->Members->Statuses->getActive()->id;

                    if ($this->request->data['action'] === 'confirm') {

                        // confirm input data
                        $member->part = $this->Members->Parts->get($member->part_id);
                        $member->member_type = $this->Members->MemberTypes->get($member->member_type_id);
                        $member->nickname_english = $this->request->data['nickname_english'];
                        $this->set(compact('member', 'parts', 'memberTypes', 'statuses'));
						$this->set('password2', $this->request->data['password2']);
						$this->set('password2_check', $this->request->data['password2_check']);
                        $this->set('_serialize', ['member']);

                        return $this->render('join_confirm');

                    } else if ($this->request->data['action'] === 'register') { 
                        // save input data
                        $member->account = MembersUtil::generateAccount(
                            $member->part_id,
                            $this->request->data['nickname_english']
                        );
                        if ($this->Members->save($member)) {
                            $this->Activities->saveJoin($member);
                            Log::write('info', 'member info was saved: id='.$member->id." nickname=".$member->nickname);

							$result_msg = $this->createRedmineUser($member, $this->request->data['password2']);
							$result_msg .= $this->checkRedmineFeatureEvent(Configure::read('Redmine.project.default'));

                            $this->Flash->success(__('Thank you for your joining!'));

                            $this->sendAutoReply($member);
                            $this->sendStaffNotification($member, $result_msg);

                            return $this->redirect(['action' => 'success']);
                        
                        } else {
                            $this->Flash->error(__('Some items are invalid. Please fix wrong items and try again.'));
                        }
                    }
                    else {
                        // aciton=back
                    }
                }
                else {
                    // 2. member info input form page [no mode=join]
                    // do nothing
                }
            }
            else {
                // show password page (1)
                Log::write('info', 'Invalid password: '.$this->request->data['password']);
                $this->Flash->error(__('Invalid password'));
                $this->set(compact('member'));
                $this->set('_serialize', ['member']);

                return $this->render('join_auth');
            }
//            }
        }
        else {
            //Log::write('debug', 'join: NOT POST');
            // 1. password form page [no POST]
            // Do nothing (Request to input password)
            $this->set(compact('member'));
            $this->set('_serialize', ['member']);
            return $this->render('join_auth');
        }

        $parts = $this->Members->Parts->find('list', ['limit' => 200, 'order' => ['id']]);
        $memberTypes = $this->Members->MemberTypes->find('list', ['limit' => 200, 'order' => ['id']]);
        $statuses = $this->Members->Statuses->find('list', ['limit' => 200, 'order' => ['id']]);
        $this->set(compact('member', 'parts', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['member']);
    }

    public function rejoin($id = null)
    {
        $this->request->allowMethod(['post', 'rejoin']);
        $member = $this->Members->get($id);
        $member->status_id = $this->Members->Statuses->getActive()->id;
        if ($this->Members->save($member)) {
            $this->Activities->saveReJoin($member);

			# When rejoin, notification mail to the member has to be sent.
            # Because of it, after the member's mail address is unstopped,
            # the mail has to be sent.

            $msg = 'The member has been re-joined.';
			$msg .= $this->setupRedmineUserForRejoin($member);

			$rm_user = RedmineUtil::findUser($member->account);
			$this->sendNoticeRejoin($member, is_null($rm_user)? null: $rm_user['mail']);

            $this->Flash->success($msg);
            return $this->redirect(['action' => 'detail', $id]);
        } else {
            $this->Flash->error('The member could not be change status. Please, try again.');
        }
    }

    public function leaveTemporary($id = null)
    {
        $this->request->allowMethod(['post', 'rest']);
        $member = $this->Members->get($id);
        $member->status_id = $this->Members->Statuses->getTempLeft()->id;
        if ($this->Members->save($member)) {
            $this->Activities->saveLeftTemporary($member);

			# When change status to 'temporary left',
            # notification mail to the member has to be sent.
            # Because of it, after send the mail, the member's 
            # mail address has to be stopped.

			$rm_user = RedmineUtil::findUser($member->account);
			$this->sendNoticeLeaveTemporary($member, is_null($rm_user)? null: $rm_user['mail']);

			$msg = 'The member has been left temporary.';
			$msg .= $this->setupRedmineUserForTempLeave($member);

            $this->Flash->success($msg);

            return $this->redirect(['action' => 'detail', $id]);
        } else {
            $this->Flash->error('The member could not be change status. Please, try again.');
        }
    }

    public function leave($id = null)
    {
        $this->request->allowMethod(['post', 'leave']);
        $member = $this->Members->get($id);
        $member->status_id = $this->Members->Statuses->getLeft()->id;
        if ($this->Members->save($member)) {
            $this->Activities->saveLeft($member);

			# When change status to 'left',
            # notification mail to the member has to be sent.
            # Because of it, after send the mail, the member's 
            # mail address has to be stopped.

			$rm_user = RedmineUtil::findUser($member->account);
			$this->sendNoticeLeave($member, is_null($rm_user)? null: $rm_user['mail']);

            $msg = 'The member has been left.';
			$msg .= $this->setupRedmineUserForLeave($member);

            $this->Flash->success($msg);
            return $this->redirect(['action' => 'detail', $id]);
        } else {
            $this->Flash->error('The member could not be change status. Please, try again.');
        }
    }

    public function update($id = null)
    {
        $member = $this->Members->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $member = $this->Members->patchEntity($member, $this->request->data);
            if ($this->Members->save($member)) {
                $this->Flash->success('The member has been saved.');
                $this->Activities->saveUpdate($member);
                return $this->redirect(['action' => 'detail', $id]);
            } else {
                $this->Flash->error('The member could not be saved. Please, try again.');
            }
        }

        $parts = $this->Members->Parts->find('list', ['limit' => 200, 'order' => ['id']]);
        $memberTypes = $this->Members->MemberTypes->find('list', ['limit' => 200, 'order' => ['id']]);
        $statuses = $this->Members->Statuses->find('list', ['limit' => 200, 'order' => ['id']]);
        $this->set(compact('member', 'parts', 'sexes', 'bloods', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['member']);
        
    }


    ////////////////////////////////////////////////////////////////////////
    //  /raw/members/
    ////////////////////////////////////////////////////////////////////////

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parts', 'MemberTypes', 'Statuses']
        ];
        $this->set('members', $this->paginate($this->Members));
        $this->set('_serialize', ['members']);
    }

    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $member = $this->Members->get($id, [
            'contain' => ['Parts', 'MemberTypes', 'Statuses', 'Activities', 'MemberHistories']
        ]);

		if(PostfixUtil::isStopped($member->email)){
			$member->email .= ' (BLOCKED)';
		}

		$rm_user = RedmineUtil::findUser($member->account);
		if(is_null($rm_user) == false){
			if(PostfixUtil::isStopped($rm_user['mail'])){
				$rm_user['mail'] .= ' (BLOCKED)';
			}
        	$this->set('rm_user', $rm_user);
		}

        $this->set('member', $member);
        $this->set('_serialize', ['member', 'rm_user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $member = $this->Members->newEntity();
        if ($this->request->is('post')) {
            $member = $this->Members->patchEntity($member, $this->request->data);
            if ($this->Members->save($member)) {
                $this->Flash->success('The member has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The member could not be saved. Please, try again.');
            }
        }
        $parts = $this->Members->Parts->find('list', ['limit' => 200, 'order' => ['id']]);
        $memberTypes = $this->Members->MemberTypes->find('list', ['limit' => 200, 'order' => ['id']]);
        $statuses = $this->Members->Statuses->find('list', ['limit' => 200, 'order' => ['id']]);
        $this->set(compact('member', 'parts', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $member = $this->Members->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $member = $this->Members->patchEntity($member, $this->request->data);
            if ($this->Members->save($member)) {
                $this->Flash->success('The member has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The member could not be saved. Please, try again.');
            }
        }
        $parts = $this->Members->Parts->find('list', ['limit' => 200, 'order' => ['id']]);
        $memberTypes = $this->Members->MemberTypes->find('list', ['limit' => 200, 'order' => ['id']]);
        $statuses = $this->Members->Statuses->find('list', ['limit' => 200, 'order' => ['id']]);
        $this->set(compact('member', 'parts', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $member = $this->Members->get($id);

        if ($this->Members->delete($member)) {
            $this->Flash->success('The member has been deleted.');
        } else {
            $this->Flash->error('The member could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }


    private function buildText($body, $member)
    {
        $body = $this->replaceTag($body, $member);

        $lines = explode("\n", $body);
        $buf = "";
        $built_body = "";
        foreach($lines as $line){
            $line = trim($line);
            $line = $this->replaceWord('(https?:\/\/[0-9a-zA-Z\-_\.\!\*\'\(\)]+)', '<a href="$1">$1</a>', $line);

            if(strlen($buf) == 0){
                if(strlen($line) > 0){
                    $buf = $line ."\n";
                } 
            }
            else{
                if(strlen($line) > 0){
                    $buf .= "<br>".$line ."\n";
                }
                else{
                    $built_body .= "<p>".$buf."</p>";
                    $buf = "";
                }
            } 
        }
        if(strlen($buf) > 0){
            $built_body .= "<p>".$buf."</p>";
        }

        return $built_body;
    }

    private function replaceWord($reg, $ptn, $txt)
    {
        $txt = preg_replace('/ '.$reg.' /', ' '.$ptn.' ', $txt);
        $txt = preg_replace('/^'.$reg.' /',     $ptn.' ', $txt);
        $txt = preg_replace('/ '.$reg.'$/', ' '.$ptn,     $txt);
        $txt = preg_replace('/^'.$reg.'$/',     $ptn,     $txt);

        return $txt;
    }

    private function replaceTag($text, $member)
    {
        $text = str_replace('((#part#))', $this->Members->Parts->get($member->part_id)->name, $text);
        $text = str_replace('((#nickname#))', $member->nickname, $text);
        $text = str_replace('((#name#))', $member->name, $text);
        $text = str_replace('((#account#))', $member->account, $text);
        $text = str_replace('((#phone#))', $member->phone, $text);
        $text = str_replace('((#email#))', $member->email, $text);
        $text = str_replace('((#home_address#))', $member->home_address, $text);
        $text = str_replace('((#work_address#))', $member->work_address, $text);
        $text = str_replace('((#member_type#))', $this->Members->MemberTypes->get($member->member_type_id)->name, $text);
        $text = str_replace('((#emergency_phone#))', $member->emergency_phone, $text);
        $text = str_replace('((#note#))', $member->note, $text);

        return $text;
    }

    private function buildMailSubject($subject, $member)
    {
        return $this->replaceTag($subject, $member);
    }

    private function buildMailBody($body, $member)
    {
        return $this->replaceTag($body, $member);
    }


    private function strToMailArray($str)
    {
        $email_list = array();
        if (empty($str)) {
            return $email_list;
        }

        foreach(explode(',', $str) as $email){
            $email = trim($email);
            if(strlen($email) > 0){
                array_push($email_list, $email); 
            }
        }

        return $email_list;
    }

    private function sendAutoReply($member)
    {
        $from = $this->Settings->findByName('mail.full.from')->first()->value;
        //$tolist = $this->strToMailArray($this->Settings->findByName('mail.full.to')->first()->value);
        $cclist = $this->strToMailArray($this->Settings->findByName('mail.full.cc')->first()->value);
        $bcclist = $this->strToMailArray($this->Settings->findByName('mail.full.bcc')->first()->value);
        $subject = $this->Settings->findByName('mail.full.subject')->first()->value;
        $body = $this->Settings->findByName('mail.full.body')->first()->value;

        $email = new Email('default');
        //$email->sender($from)
        $email->to($member->email)
              ->cc($cclist)
              ->bcc($bcclist)
              ->subject($this->buildMailSubject($subject, $member))
              ->send($this->buildMailBody($body, $member));
        
        Log::write('info', 'Sent auto reply mail to '.$member->email.', '.
							(is_null($cclist)? '': implode(', ', $cclist)).', '.
							(is_null($bcclist)? '': implode(', ', $bcclist))
					);
    }

    private function sendStaffNotification($member, $result_msg = null)
    {
        $from = $this->Settings->findByName('mail.abst.from')->first()->value;
        $tolist = $this->strToMailArray($this->Settings->findByName('mail.abst.to')->first()->value);
        $cclist = $this->strToMailArray($this->Settings->findByName('mail.abst.cc')->first()->value);
        $bcclist = $this->strToMailArray($this->Settings->findByName('mail.abst.bcc')->first()->value);
        $subject = $this->Settings->findByName('mail.abst.subject')->first()->value;
        $body = $this->Settings->findByName('mail.abst.body')->first()->value;
		if(is_null($result_msg) == false){
			$body .= "\n\n\n";
			$body .= "*** ".__("Redmine Result")." ***\n\n";
			$body .= $result_msg;
		}

        if(count($tolist) == 0){
            Log::write('warning', 'No email address to send notification mail. do nothing.');
            return;
        }

        $email = new Email('default');
        //$email->sender($from)
        $email->to($tolist)
              ->cc($cclist)
              ->bcc($bcclist)
              ->subject($this->buildMailSubject($subject, $member))
              ->send($this->buildMailBody($body, $member));

        Log::write('info', 'Sent staff notification mail to '.implode(', ', $tolist).', '.
							(is_null($cclist)? '': implode(', ', $cclist)).', '.
							(is_null($bcclist)? '': implode(', ', $bcclist))
					);
    }

	/**
	 * @param $mail_label ... leavetemp, rejoin, leave
     * @param $member     ... member object
     * @param $to         ... send to this address instead of $member->email.
     *                        if null, send to $member->email
     */
    private function sendNotice($mail_label, $member, $to = null)
    {
        $from = $this->Settings->findByName('mail.'.$mail_label.'.from')->first()->value;

        //$tolist = $this->strToMailArray($this->Settings->findByName('mail.full.to')->first()->value);
		$to_adr = is_null($to)? $member->email: $to;
        $cclist = $this->strToMailArray($this->Settings->findByName('mail.'.$mail_label.'.cc')->first()->value);
        $bcclist = $this->strToMailArray($this->Settings->findByName('mail.'.$mail_label.'.bcc')->first()->value);
        $subject = $this->Settings->findByName('mail.'.$mail_label.'.subject')->first()->value;
        $body = $this->Settings->findByName('mail.'.$mail_label.'.body')->first()->value;

        $email = new Email('default');
        $email->to($to_adr)
              ->cc($cclist)
              ->bcc($bcclist)
              ->subject($this->buildMailSubject($subject, $member))
              ->send($this->buildMailBody($body, $member));
                
    }

    private function sendNoticeLeaveTemporary($member, $to = null)
    {
		$this->sendNotice('leavetemp', $member, $to);
    }

    private function sendNoticeRejoin($member, $to = null)
    {
		$this->sendNotice('rejoin', $member, $to);
    }

    private function sendNoticeLeave($member, $to = null)
    {
		$this->sendNotice('leave', $member, $to);
    }

}
