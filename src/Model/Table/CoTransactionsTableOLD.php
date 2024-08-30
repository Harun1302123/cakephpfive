<?php
namespace App\Model\Table;

use App\Model\Entity\Center;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CoTransactionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('CoTransactions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

      
    }    

 
}