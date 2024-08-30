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
class AlertSettingsTable extends Table
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

        $this->setTable('alert_settings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->belongsTo('AlertTypes', [
            'foreignKey' => 'alert_type_id',
            'joinType' => 'INNER'
        ]);


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
            ->requirePresence('alert_type_id', 'create')
            ->notEmpty('alert_type_id');

       /* $validator
            ->requirePresence('alert_text', 'create')
            ->notEmpty('alert_text');*/

		$validator
            ->requirePresence('delivery', 'create')
            ->notEmpty('delivery');

        return $validator;
    }


}
