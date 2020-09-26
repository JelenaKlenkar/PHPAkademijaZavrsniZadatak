<?php
declare(strict_types=1);
namespace App\Model\Team;
use App\Core\Database;

class TeamResource{

    public function  insertTeam($data){
        $db=Database::getInstance();
        $statement=$db->prepare('INSERT into team (name_of_team) values (:name_of_team)');

        $statement->bindValue('name_of_team',$data['name_of_team']);


        $result=$statement->execute();
        return $result;
    }

}
