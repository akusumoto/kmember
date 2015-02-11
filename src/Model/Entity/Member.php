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
        'sex_id' => true,
        'blood_id' => true,
        'birth' => true,
        'home_address' => true,
        'phone' => true,
        'email' => true,
        'work_name' => true,
        'work_address' => true,
        'work_phone' => true,
        'member_type_id' => true,
        'parent_phone' => true,
        'note' => true,
        'status_id' => true,
        'part' => true,
        'sex' => true,
        'blood' => true,
        'member_type' => true,
        'status' => true,
        'activities' => true,
        'member_histories' => true,
    ];
}
