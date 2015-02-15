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
        $account_part = '';
        switch ($part_id) {
            case Part::VN1: $account_part = 'VN'; break;
            case Part::VN2: $account_part = 'VN'; break;
            case Part::VA: $account_part = 'VA'; break;
            case Part::VC: $account_part = 'VC'; break;
            case Part::CB: $account_part = 'CB'; break;

            case Part::FL: $account_part = 'FL'; break;
            case Part::CL: $account_part = 'CL'; break;
            case Part::SAX: $account_part = 'SAX'; break;
            case Part::FG: $account_part = 'FG'; break;

            case Part::HR: $account_part = 'HR'; break;
            case Part::TP: $account_part = 'TP'; break;
            case Part::TB: $account_part = 'TB'; break;
            case Part::TU: $account_part = 'TU'; break;

            case Part::PERC: $account_part = 'PERC'; break;

            case Part::GT: $account_part = 'GT'; break;
            case Part::SYN: $account_part = 'SYN'; break;
            case Part::PF: $account_part = 'PF'; break;

            case Part::CHO_SP: $account_part = 'CHO'; break;
            case Part::CHO_AL: $account_part = 'CHO'; break;
            case Part::CHO_TN: $account_part = 'CHO'; break;
            case Part::CHO_BS: $account_part = 'CHO'; break;

            case Part::COND: $account_part = 'COND'; break;
            case Part::STF: $account_part = 'STF'; break;

            default: return false;
        }

        return $account_part . '_' . $account_name;
    }
}
?>
