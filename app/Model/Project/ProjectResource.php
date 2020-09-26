<?php
declare(strict_types=1);

namespace App\Model\Project;
use App\Core\Database;

class ProjectResource
{
    public function  insertProject($data){
        $db=Database::getInstance();
        $statement=$db->prepare('INSERT into project (name_of_project, description_of_project, starting_date, ending_date, completed)
       values (:name_of_project,:description_of_project, :starting_date, :ending_date, :completed)');

        $statement->bindValue('name_of_project',$data['name_of_project']);
        $statement->bindValue('description_of_project',$data['description_of_project']);
        $statement->bindValue('starting_date',$data['starting_date']);
        $statement->bindValue('ending_date',$data['ending_date']);
        $statement->bindValue('completed',$data['completed']);

        $result=$statement->execute();
        return $result;
    }

}

