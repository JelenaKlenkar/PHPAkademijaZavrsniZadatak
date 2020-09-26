<?php

declare(strict_types=1);

namespace App\Model\JobPosition;

use App\Core\Database;

class JobPositionResource
{

    public function  insertJobPosition($data){
       $db=Database::getInstance();
       $statement=$db->prepare('INSERT into job_position (name_of_job_position,job_position_description)
       values (:name_of_job_position,:job_position_description)');

       $statement->bindValue('name_of_job_position',$data['name_of_job_position']);
        $statement->bindValue('job_position_description',$data['job_position_description']);

        $result=$statement->execute();
        return $result;
    }


}
