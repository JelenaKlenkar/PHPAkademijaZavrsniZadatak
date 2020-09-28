<?php

declare(strict_types=1);
namespace App\Model\Employee;

use App\Core\Database;

class EmployeeResource
{
    public function  insertEmployee($data){
        $db=Database::getInstance();
        $statement=$db->prepare('INSERT into employee (first_name, last_name, email, personal_identification_number, phone_number)
       values (:first_name,:last_name, :email, :personal_identificational_number, :phone_number)');

        $statement->bindValue('first_name',$data['first_name']);
        $statement->bindValue('last_name',$data['last_name']);
        $statement->bindValue('email',$data['email']);
        $statement->bindValue('personal_identification_number',$data['personal_identification_number']);
        $statement->bindValue('phone_number',$data['phone_number']);

        $result=$statement->execute();
        return $result;
    }

}

