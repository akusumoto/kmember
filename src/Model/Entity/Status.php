<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity.
 */
class Status extends Entity
{
    const ACTIVE = 1;
    const RESTING = 2;
    const LEFT = 3;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'name' => true,
        'member_histories' => true,
        'members' => true,
    ];
}
