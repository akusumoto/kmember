<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Matome Entity.
 */
class Matome extends Entity
{
    const TOP = 1;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'name' => true,
        'body' => true,
        'parent_matome' => true,
    ];
}
