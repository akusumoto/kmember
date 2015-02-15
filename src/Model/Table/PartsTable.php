<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parts Model
 */
class PartsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('parts');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('MemberHistories', [
            'foreignKey' => 'part_id'
        ]);
        $this->hasMany('Members', [
            'foreignKey' => 'part_id'
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
            ->requirePresence('id', 'create')
            ->notEmpty('id')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
