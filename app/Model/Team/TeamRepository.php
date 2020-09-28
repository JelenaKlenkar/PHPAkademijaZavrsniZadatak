<?php
declare(strict_types=1);

namespace App\Model\Team;

use App\Core\DataObjectRepositoryInterface;
use App\Core\Database;

class TeamRepository implements DataObjectRepositoryInterface{

    public function getList()
    {
        $list=[];
        $db=Database::getInstance();
        $statement=$db->prepare("select id,name_of_team from team");
        $statement->execute();
        foreach ($statement->fetchAll() as $post){
            $list=new Team([
                'id'=>$post ->id,
                'name_of_team' =>$post->name_of_team
            ]);
        }
        return $list;
    }
}
