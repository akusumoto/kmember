<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activities Model
 */
class ActivitiesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('activities');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('member_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('member_id', 'create')
            ->notEmpty('member_id')
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        return $rules;
    }


    public function saveJoin($member)
    {
        $history = $this->newEntity();

        $history->member = $member;
        $history->action = "joined";

        $this->save($history);
    }

    public function saveUpdate($member)
    {
        $history = $this->newEntity();

        $history->member = $member;
        $history->action = "updated";

        $this->save($history);
    }

    public function saveLeft($member)
    {
        $history = $this->newEntity();

        $history->member = $member;
        $history->action = "left";

        $this->save($history);
    }

    public function saveLeftTemporary($member)
    {
        $history = $this->newEntity();

        $history->member = $member;
        $history->action = "left temporary";

        $this->save($history);
    }

    public function saveReJoin($member)
    {
        $history = $this->newEntity();

        $history->member = $member;
        $history->action = "re-joined";

        $this->save($history);
    }
}
