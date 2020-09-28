<?php

declare(strict_types=1);

namespace  App\Model\Task;
use App\Core\Database;

class TaskResource
{
    public function  insertTask($data){
        $db=Database::getInstance();
        $statement=$db->prepare('INSERT into task (description, closed)
       values (:description,:closed)');

        $statement->bindValue('description',$data['description']);
        $statement->bindValue('closed',$data['closed']);


        $result=$statement->execute();
        return $result;
    }

}
