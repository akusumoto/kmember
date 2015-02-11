<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity.
 */
class Part extends Entity
{

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
