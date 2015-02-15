<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity.
 */
class Member extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'part_id' => true,
        'nickname' => true,
        'name' => true,
        'account' => true,
        'email' => true,
        'home_address' => true,
        'work_address' => true,
        'member_type_id' => true,
        'emergency_phone' => true,
        'note' => true,
        'status_id' => true,
        'part' => true,
        'member_type' => true,
        'status' => true,
        'activities' => true,
        'member_histories' => true,
    ];
}
