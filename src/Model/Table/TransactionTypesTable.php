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
class TransactionTypesTable extends Table
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

        $this->setTable('transaction_types');
        $this->setDisplayField('transaction_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }
}
