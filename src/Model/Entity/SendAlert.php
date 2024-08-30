<?php
// src/Model/Entity/SendAlert.php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SendAlert extends Entity
{
    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'send_alert_id' => false
    ];
}





