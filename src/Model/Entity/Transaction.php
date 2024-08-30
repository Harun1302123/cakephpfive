<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Transaction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */

	// Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];


	 protected function _getTotalFees()
    {
        return ($this->_properties['gov_fees']+$this->_properties['typing_fees']);
    }


}
