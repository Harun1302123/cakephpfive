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
class CompanyTransactionsTable extends Table
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

        $this->setTable('company_transactions');
        //$this->displayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('TransactionTypes', [
            // 'BindingKey' => 'transaction_type_id',
			'foreignKey' => 'transaction_type_id',
            'joinType' => 'LEFT'
        ]);

		/*$this->hasOne('TransactionTypes', [
            'BindingKey' => 'transaction_type_id',
			'foreignKey' => 'id',
        	'joinType' => 'LEFT'
		]);

        $this->belongsTo('TransactionTypes', [
            'foreignKey' => 'transaction_type_id',
            'joinType' => 'LEFT'
        ]);*/

		$this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
			//'joinType' => 'LEFT',
			'conditions' => array('CompanyTransactions.for_whom' => '1')
        ]);

		$this->belongsTo('Dependents', [
            'foreignKey' => 'dependet_id',
			//'joinType' => 'LEFT',
			'conditions' => array('CompanyTransactions.for_whom' => '2')
        ]);

		$this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);

		$this->hasMany('TrasectionsRelation', [
            'foreignKey' => 'transaction_id',
			'joinType' => 'LEFT'
        ]);




    }

	public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('company_id', 'create')
            ->notEmpty('company_id');

       /* $validator
            ->requirePresence('transaction_id', 'create')
            ->notEmpty('transaction_id');*/

		$validator
            ->requirePresence('transaction_type_id', 'create')
            ->notEmpty('transaction_type_id');

        return $validator;
    }


}
