<?php
namespace App\Model\Table;


use Cake\ORM\Table;

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
class StatusTransactionsTable extends Table
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

        $this->setTable('status_transactions');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
         $this->hasMany('CenterAttachments', [
             'foreignKey' => 'center_id'
         ]);

		 $this->belongsTo('Trainers', [
            'foreignKey' => 'trainer_id',
            'joinType' => 'INNER'
        ]);*/

        // $this->hasMany('CenterCourseIds', [
            // 'foreignKey' => 'center_id'
        // ]);
        // $this->hasMany('Locations', [
            // 'foreignKey' => 'center_id'
        // ]);
        // $this->hasMany('Trainees', [
            // 'foreignKey' => 'center_id'
        // ]);
        // $this->hasMany('Trainers', [
            // 'foreignKey' => 'center_id'
        // ]);
    }
}
