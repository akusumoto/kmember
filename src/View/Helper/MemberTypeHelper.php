<?php
namespace App\View\Helper;

use App\Model\Entity\MemberType;
use Cake\View\Helper;
use Cake\View\View;

/**
 * MemberType helper
 */
class MemberTypeHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function isStudent($member_type)
    {
        return ($member_type->id, MemberType::STUDENT)? true: false;
    }
}
