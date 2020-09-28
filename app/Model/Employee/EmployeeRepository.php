<?php

declare(strict_types=1);

namespace App\Model\Employee;

use App\Core\DataObjectRepositoryInterface;
use App\Core\Database;

class EmployeeRepository implements DataObjectRepositoryInterface{


    public function getList()
    {
        $list=[];
        $db=Database::getInstance();
        $statement=$db->prepare("select id,first_name,last_name,email,personal_identification_number,phone_number from employee");
        $statement->execute();
        foreach ($statement->fetchAll() as $post){
            $list=new Employee([
                'id'=>$post ->id,
                'first_name' =>$post->first_name,
                'last_name' =>$post ->last_name,
                'email'=>$post ->email,
                'personal_identification_number'=>$post ->personal_identification_number,
                'phone_number'=>$post ->phone_number

            ]);
        }
        return $list;
    }
}
