<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Statuses Model
 */
class StatusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('statuses');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('MemberHistories', [
            'foreignKey' => 'status_id'
        ]);
        $this->hasMany('Members', [
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
            ->requirePresence('id', 'create')
            ->notEmpty('id')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function getActive()
    {
        return $this->get(1);
    }

    public function getTempLeft()
    {
        return $this->get(2);
    }

    public function getLeft()
    {
        return $this->get(3);
    }
}
