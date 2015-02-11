<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blood Entity.
 */
class Blood extends Entity
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
