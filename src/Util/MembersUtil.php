<?php
namespace App\Util;

use App\Model\Entity\Part;
use Cake\Log\Log;

/**
 * Members Utility
 */
class MembersUtil
{
    public static function generateAccount($part_id, $name)
    {
        Log::write('debug', 'part_id='.$part_id.' name='.$name);
        $account_name = strtoupper($name);
        $account_part = Part::getPartPrefix($part_id);
        if(is_null($account_part)){
            return false;
        }

        return $account_part . '_' . $account_name;
    }
}
?>
