<?php
namespace App\View\Helper;

use App\Model\Entity\MemberType;
use App\Model\Entity\Status;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Member helper
 */
class MemberHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function isStudent($member)
    {
        return (strcmp($member->member_type->name, MemberType::STUDENT) == 0? true: false);
    }

    public function isLeft($member)
    {
        return (strcmp($member->status->name, Status::LEFT) == 0? true: false);
    }

    public function isRest($member)
    {
        return ($member->status->name === Status::RESTING? true: false);
    }
}
