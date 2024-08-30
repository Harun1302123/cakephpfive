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
class SendAlertTable extends Table
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

        $this->setTable('send_alert');
        $this->setPrimaryKey('send_alert_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'conditions' => array('SendAlert.for_whom' => '1'),
        ]);

        $this->belongsTo('Dependents', [
            'foreignKey' => 'dependet_id',
            'conditions' => array('SendAlert.for_whom' => '2'),
        ]);

        $this->belongsTo('AlertTypes', [
            'foreignKey' => 'alert_types_id',
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
        //$validator
        //    ->allowEmpty('id', 'create');

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
