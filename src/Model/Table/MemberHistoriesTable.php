<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberHistories Model
 */
class MemberHistoriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('member_histories');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id'
        ]);
        $this->belongsTo('Parts', [
            'foreignKey' => 'part_id'
        ]);
        $this->belongsTo('Sexes', [
            'foreignKey' => 'sex_id'
        ]);
        $this->belongsTo('Bloods', [
            'foreignKey' => 'blood_id'
        ]);
        $this->belongsTo('MemberTypes', [
            'foreignKey' => 'member_type_id'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id'
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
            ->allowEmpty('reason')
            ->add('part_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('part_id', 'create')
            ->notEmpty('part_id')
            ->requirePresence('nickname', 'create')
            ->notEmpty('nickname')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('account', 'create')
            ->notEmpty('account')
            ->add('sex_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('sex_id', 'create')
            ->notEmpty('sex_id')
            ->add('blood_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('blood_id', 'create')
            ->notEmpty('blood_id')
            ->add('birth', 'valid', ['rule' => 'date'])
            ->requirePresence('birth', 'create')
            ->notEmpty('birth')
            ->requirePresence('home_address', 'create')
            ->notEmpty('home_address')
            ->requirePresence('phone', 'create')
            ->notEmpty('phone')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->allowEmpty('work_name')
            ->allowEmpty('work_address')
            ->allowEmpty('work_phone')
            ->add('member_type_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('member_type_id', 'create')
            ->notEmpty('member_type_id')
            ->allowEmpty('parent_phone')
            ->allowEmpty('note')
            ->add('status_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status_id', 'create')
            ->notEmpty('status_id');

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['part_id'], 'Parts'));
        $rules->add($rules->existsIn(['sex_id'], 'Sexes'));
        $rules->add($rules->existsIn(['blood_id'], 'Bloods'));
        $rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));
        return $rules;
    }
}
