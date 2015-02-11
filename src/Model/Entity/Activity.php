<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity.
 */
class Activity extends Entity
{
    const JOIN = '入団';
    const UPDATE = '団員情報更新';
    const TEMPLEAVE = '休団';
    const REJOIN = '復団';
    const LEAVE = '退団';
    const DELETE = '団員情報削除';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'member_id' => true,
        'action' => true,
        'member' => true,
    ];
}
