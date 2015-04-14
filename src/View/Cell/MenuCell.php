<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\Status;
use App\Model\Entity\Part;

/**
 * Menu cell
 */
class MenuCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('Members');

        #$total = $this->Members->find('all', ['contain' => ['Statuses']])->where(['Statuses.id <> '.Status::LEFT])->count();
        $total_active = $this->Members->find()->where(['status_id = '.Status::ACTIVE])->count();
        $total_resting = $this->Members->find()->where(['status_id = '.Status::RESTING])->count();
        $total_left = $this->Members->find()->where(['status_id = '.Status::LEFT])->count();
        $this->set('total', $total_active + $total_resting);
        $this->set('total_active', $total_active);
        $this->set('total_resting', $total_resting);
        $this->set('total_left', $total_left);

        $total_orchestra = $this->Members->find()->where(['status_id <> '.Status::LEFT, 'part_id IN' => Part::getPartIdListOrchestra()])->count();
        $total_chorus = $this->Members->find()->where(['status_id <> '.Status::LEFT, 'part_id IN' => Part::getPartIdListChorus()])->count();
        $total_other = $total_active + $total_resting - $total_orchestra - $total_chorus;
        $this->set('total_orchestra', $total_orchestra);
        $this->set('total_chorus', $total_chorus);
        $this->set('total_other', $total_other);


        $this->loadModel('Parts');
        $query = $this->Parts->find()
                ->leftJoin(
                    ['Members' => 'members'],
                    ['Members.part_id = Parts.id', 'Members.status_id <> '.Status::LEFT])
                ->group('Parts.id')->order('Parts.id');
        $query->select(['id' => 'Parts.id', 'name' => 'Parts.name', 'count' => $query->func()->count('Members.id')]);

        $parts = $query->all(); 
        $this->set('parts', $parts);
    }
}
