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
        return ($member->member_type_id == MemberType::STUDENT? true: false);
    }

    public function isActive($member)
    {
        return ($member->status_id == Status::ACTIVE? true: false);
    }

    public function isLeft($member)
    {
        return ($member->status_id == Status::LEFT? true: false);
    }

    public function isRest($member)
    {
        return ($member->status_id === Status::RESTING? true: false);
    }
}
