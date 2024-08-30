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
class DependentsTable extends Table
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

        $this->setTable('dependents');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);

		$this->hasMany('Documents', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'dependent')
        ]);

		$this->hasOne('ClientsDocuments', [
            'foreignKey' => 'person_id',
			'conditions' => array('ClientsDocuments.section_name' => 'dependent')
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
            ->requirePresence('employee_id', 'create')
            ->notEmpty('employee_id');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

		$validator
            ->requirePresence('relation', 'create')
            ->notEmpty('relation');

        return $validator;
    }
}
