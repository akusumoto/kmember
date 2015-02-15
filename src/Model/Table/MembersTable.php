<?php
namespace App\Model\Table;

use App\Util\MembersUtil;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Members Model
 */
class MembersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('members');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Parts', [
            'foreignKey' => 'part_id'
        ]);
        $this->belongsTo('MemberTypes', [
            'foreignKey' => 'member_type_id'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id'
        ]);
        $this->hasMany('Activities', [
            'foreignKey' => 'member_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
        $this->hasMany('MemberHistories', [
            'foreignKey' => 'member_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
            ->add('part_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('part_id', 'create')
            ->notEmpty('part_id')

            ->add('nickname', ['unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => __('Already exist')
            ]])
            ->requirePresence('nickname', 'create')
            ->notEmpty('nickname')

            ->add('nickname_english', ['unique' => [
                'rule' => function($value, $context) {
                    $account = MembersUtil::generateAccount($context['data']['part_id'], $value);
                    if ($account === false) {
                        Log::write('error', 'failed to generate accout: part_id='.$part_id.' nickname='.$value);
                        return false;
                    }
                    return ($this->findByAccount($account)->count() > 0)? false: true;
                },
                'message' => __('Already exist')
            ]])
            ->requirePresence('nickname_english', 'create')
            ->notEmpty('nickname_english')

            ->add('name', ['unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => __('Already exist')
            ]])
            ->requirePresence('name', 'create')
            ->notEmpty('name')

            ->add('account', ['unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => __('Already exist')
            ]])
            ->requirePresence('account', 'create')
            ->notEmpty('account')

            ->add('email', 'valid', ['rule' => 'email', 'unique' => ['rule' => 'validateUnique', 'provider' => 'table']])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->allowEmpty('home_address')
            ->allowEmpty('work_address')
            ->add('member_type_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('member_type_id', 'create')
            ->notEmpty('member_type_id')
            ->allowEmpty('emergency_phone')
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
        $rules->add($rules->existsIn(['part_id'], 'Parts'));
        $rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));
        return $rules;
    }
}
