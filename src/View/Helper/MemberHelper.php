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

    public function isActive($member)
    {
        return ($member->status->id == Status::ACTIVE? true: false);
    }

    public function isLeft($member)
    {
        return ($member->status->id == Status::LEFT? true: false);
    }

    public function isRest($member)
    {
        return ($member->status->id === Status::RESTING? true: false);
    }
}
