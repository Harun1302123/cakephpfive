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
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserRoles', [
            'foreignKey' => 'user_role_id',
            'joinType' => 'INNER'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('Username', 'create')
            ->notEmpty('Username');

        $validator
            ->requirePresence('Password', 'create')
            ->notEmpty('Password');

		 $validator
            ->requirePresence('user_role_id', 'create')
            ->notEmpty('user_role_id');

		$validator->add(
				'email',
				['unique' => [
					'rule' => 'validateUnique',
					'provider' => 'table',
					'message' => 'Not unique']
				]
			);

		$validator->add(
				'Username',
				['unique' => [
					'rule' => 'validateUnique',
					'provider' => 'table',
					'message' => 'Not unique']
				]
			);

        return $validator;
    }
}
