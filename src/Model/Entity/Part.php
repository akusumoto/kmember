<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

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
    const OB  = 15;

    const HR  = 21;
    const TP  = 22;
    const TB  = 23;
    const TU  = 24;

    const PERC = 31;
    const HP  = 32;

    const GT  = 41;
    const SYN = 42;
    const BS  = 43;
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

    public static function getPartIdListOrchestra() {
        return [
            Part::VN1, Part::VN2, Part::VA, Part::VC, Part::CB,
            Part::FL, Part::CL, Part::SAX, Part::FG, Part::OB,
            Part::HR, Part::TP, Part::TB, Part::TU,
            Part::PERC, Part::HP
        ];
    }

    public static function getPartIdListChorus() {
        return [
            Part::CHO_SP, Part::CHO_AL, Part::CHO_TN, Part::CHO_BS
        ];
    }

	public static function getPartPrefix($part_id){
        switch ($part_id) {
            case Part::VN1: return 'VN';
            case Part::VN2: return 'VN';
            case Part::VA: return 'VA';
            case Part::VC: return 'VC';
            case Part::CB: return 'CB';

            case Part::FL: return 'FL';
            case Part::CL: return 'CL';
            case Part::SAX: return 'SAX';
            case Part::FG: return 'FG';
            case Part::OB: return 'OB';

            case Part::HR: return 'HR';
            case Part::TP: return 'TP';
            case Part::TB: return 'TB';
            case Part::TU: return 'TU';

            case Part::PERC: return 'PERC';
            case Part::HP: return 'HP';

            case Part::GT: return 'GT';
            case Part::SYN: return 'SYN';
            case Part::PF: return 'PF';
            case Part::BS: return 'BS';

            case Part::CHO_SP: return 'CHO';
            case Part::CHO_AL: return 'CHO';
            case Part::CHO_TN: return 'CHO';
            case Part::CHO_BS: return 'CHO';

            case Part::COND: return 'COND';
            case Part::STF: return 'STF';

            default: return null;
        } 
	}

	public static function getGroupName($part_id){
		switch($part_id){
            case Part::VN1: return Configure::read('Redmine.group.string');
            case Part::VN2: return Configure::read('Redmine.group.string');
            case Part::VA: return Configure::read('Redmine.group.string');
            case Part::VC: return Configure::read('Redmine.group.string');
            case Part::CB: return Configure::read('Redmine.group.string');

            case Part::FL: return Configure::read('Redmine.group.brass');
            case Part::CL: return Configure::read('Redmine.group.brass');
            case Part::SAX: return Configure::read('Redmine.group.brass');
            case Part::FG: return Configure::read('Redmine.group.brass');
            case Part::OB: return Configure::read('Redmine.group.brass');

            case Part::HR: return Configure::read('Redmine.group.brass');
            case Part::TP: return Configure::read('Redmine.group.brass');
            case Part::TB: return Configure::read('Redmine.group.brass');
            case Part::TU: return Configure::read('Redmine.group.brass');

            case Part::PERC: return Configure::read('Redmine.group.other');
            case Part::HP: return Configure::read('Redmine.group.other');

            case Part::GT: return Configure::read('Redmine.group.other');
            case Part::SYN: return Configure::read('Redmine.group.other');
            case Part::PF: return Configure::read('Redmine.group.other');
            case Part::BS: return Configure::read('Redmine.group.other');

            case Part::CHO_SP: return Configure::read('Redmine.group.chorus');
            case Part::CHO_AL: return Configure::read('Redmine.group.chorus');
            case Part::CHO_TN: return Configure::read('Redmine.group.chorus');
            case Part::CHO_BS: return Configure::read('Redmine.group.chorus');

            case Part::COND: return Configure::read('Redmine.group.other');
            case Part::STF: return Configure::read('Redmine.group.other');

            default: return null;
        }
	}
}
