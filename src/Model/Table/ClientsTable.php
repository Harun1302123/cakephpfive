<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
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
class ClientsTable extends Table
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

        // $this->table('clients');
        // $this->displayField('name');
        // $this->primaryKey('id');

        $this->setTable('clients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->hasMany('Documents', [
            'foreignKey' => 'related_id'
        ]);

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);


    }

	 public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {

		 $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('company_id', 'create')
            ->notEmpty('company_id');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

		$validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

		$validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');

		$validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

		$validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

		$validator->add(
				'email',
				['unique' => [
					'rule' => 'validateUnique',
					'provider' => 'table',
					'message' => 'Not unique']
				]
			);

		$validator->add(
				'username',
				['unique' => [
					'rule' => 'validateUnique',
					'provider' => 'table',
					'message' => 'Not unique']
				]
			);


        return $validator;

    }

	public function identify_user($post)
    {
		if (isset($post['Username']) && !empty($post['Username']) && isset($post['Password']) && !empty($post['Password'])) {
			$username = $post['Username'];
			$password = $post['Password'];
			$articles = TableRegistry::get('Clients');
			$query = $articles->find('all')->where(['username'=> $username])->first();

			if(!empty($query)){
				$obj = new DefaultPasswordHasher;
				$postpassword = $obj->check($password, $query->password);

				if($postpassword){
					return $query->toArray();
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}




}
