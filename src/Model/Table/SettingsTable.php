<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Centers
 * @property \Cake\ORM\Association\HasMany $Trainers
 * @property \Cake\ORM\Association\HasMany $Verifiers
 */
class SettingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('settings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('apiKey', 'create')
            ->notEmpty('apiKey');

        $validator
            ->requirePresence('smsUsr', 'create')
            ->notEmpty('smsUsr');

		$validator
            ->requirePresence('smsPass', 'create')
            ->notEmpty('smsPass');

		$validator
            ->requirePresence('alert_bf', 'create')
            ->notEmpty('alert_bf');


        return $validator;
    }
}
