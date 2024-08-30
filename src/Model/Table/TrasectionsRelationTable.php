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
class TrasectionsRelationTable extends Table
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
        $this->setTable('trasections_relation');
        //$this->displayField('name');
        $this->setPrimaryKey('trasections_relation_id');
        $this->addBehavior('Timestamp');

		$this->belongsTo('CompanyTransactions', [
            'foreignKey' => 'transaction_id',
		]);

		$this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }
}
