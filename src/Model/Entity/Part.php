<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity.
 */
class Part extends Entity
{
    const VN1 = 1;
    const VN2 = 2;
    const VA  = 3;
    const VC  = 4;
    const CB  = 5;

    const FL  = 11;
    const CL  = 12;
    const SAX = 13;
    const FG  = 14;

    const HR  = 21;
    const TP  = 22;
    const TB  = 23;
    const TU  = 24;

    const PERC = 31;

    const GT  = 41;
    const SYN = 42;
    const PF  = 45;

    const CHO_SP = 51;
    const CHO_AL = 52;
    const CHO_TN = 53;
    const CHO_BS = 54;

    const COND = 90;
    const STF  = 99;

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
