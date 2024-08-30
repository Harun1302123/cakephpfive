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
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->hasOne('transaction', [
            'foreignKey' => 'transaction_id',
        ]);

		$this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('TransactionTypes', [
            'foreignKey' => 'transaction_type',
            'joinType' => 'INNER'
        ]);

		$this->hasMany('Documents', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'employee')
        ]);

		$this->hasOne('ClientsDocuments', [
            'foreignKey' => 'person_id',
			'conditions' => array('ClientsDocuments.section_name' => 'employee')
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
            ->requirePresence('company_id', 'create')
            ->notEmpty('company_id');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

		$validator
            ->requirePresence('email', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
