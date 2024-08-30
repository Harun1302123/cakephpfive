<?php
namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Centers
 * @property \Cake\ORM\Association\HasMany $Trainers
 * @property \Cake\ORM\Association\HasMany $Verifiers
 */
class UserRolesTable extends Table
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

        $this->setTable('user_roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }
}
