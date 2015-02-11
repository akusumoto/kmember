<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity.
 */
class Status extends Entity
{
    const ACTIVE = 'Active';
    const RESTING = 'Resting';
    const LEFT = 'Left';

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
