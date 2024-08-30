<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attachments Model
 *
 * @property \Cake\ORM\Association\HasMany $CenterAttachmentsIds
 */
class DocumentsTable extends Table
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

        $this->setTable('documents');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


		$this->belongsTo('Companies', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'company')
        ]);

		$this->belongsTo('Dependents', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'dependent')
        ]);

		$this->belongsTo('Employees', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'employee')
        ]);


       /*$this->hasMany('Documents', [
            'foreignKey' => 'related_id'
        ]);*/
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
