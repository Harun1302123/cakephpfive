<?php
namespace App\Model\Table;

use App\Model\Entity\Center;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
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
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');



        $this->addBehavior('Timestamp');

		$this->hasMany('Documents', [
            'foreignKey' => 'related_id',
			'conditions' => array('Documents.sectionName' => 'company')
        ]);

		/*$this->belongsTo('Clients', [
            'foreignKey' => 'company_id'
        ]);*/



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

