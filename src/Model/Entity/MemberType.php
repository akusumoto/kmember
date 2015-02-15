<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MemberType Entity.
 */
class MemberType extends Entity
{
    const WORKER = 1;
    const STUDENT = 2;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'member_histories' => true,
        'members' => true,
    ];
}
