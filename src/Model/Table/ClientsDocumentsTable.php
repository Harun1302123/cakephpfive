<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Centers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $CenterAttachmentsIds
 * @property \Cake\ORM\Association\HasMany $CenterCourseIds
 * @property \Cake\ORM\Association\HasMany $Locations
 * @property \Cake\ORM\Association\HasMany $Trainees
 * @property \Cake\ORM\Association\HasMany $Trainers
 */
class ClientsDocumentsTable extends Table
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

        $this->setTable('clients_documents');
        //$this->displayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->belongsTo('Transactions', [
        'foreignKey' => 'clients_documents_id',
        'joinType' => 'LEFT'
        ]);

        $this->belongsTo('TransactionTypes', [
        'foreignKey' => 'clients_documents_id',
        'joinType' => 'LEFT'
        ]);*/

        $this->belongsTo('Employees', [
            'foreignKey' => 'person_id',
            'conditions' => array('ClientsDocuments.section_name' => 'employee'),
        ]);

        $this->belongsTo('Dependents', [
            'foreignKey' => 'person_id',
            'conditions' => array('ClientsDocuments.section_name' => 'dependent'),
        ]);

    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmpty('id', 'create');

        /* $validator
        ->requirePresence('company_id', 'create')
        ->notEmpty('company_id');

        $validator
        ->requirePresence('transaction_id', 'create')
        ->notEmpty('transaction_id');

        $validator
        ->requirePresence('transaction_type_id', 'create')
        ->notEmpty('transaction_type_id');*/

        return $validator;
    }

}
