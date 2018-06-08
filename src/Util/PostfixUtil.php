<?php

namespace App\Util;

use Cake\Log\Log;


/**
 * Postfix Utility
 */
class PostfixUtil
{
    public static function stopMail($mail)
	{
		Log::write('info', '/usr/bin/sudo '.ROOT.'/bin/stopmail.sh '.$mail);
		$output = shell_exec('/usr/bin/sudo '.ROOT.'/bin/stopmail.sh '.$mail);
		return $output;
	}

    public static function unStopMail($mail)
	{
		Log::write('info', '/usr/bin/sudo '.ROOT.'/bin/unstopmail.sh '.$mail);
		$output = shell_exec('/usr/bin/sudo '.ROOT.'/bin/unstopmail.sh '.$mail);
		return $output;
	}

	public static function isStopped($mail)
	{
		$file = file_get_contents('/etc/postfix/transport');
		$text = explode("\n",$file);

		$ret = preg_grep("/^$mail/", $text);

		return (count($ret) == 0)? false: true;
	}	
}

?>
