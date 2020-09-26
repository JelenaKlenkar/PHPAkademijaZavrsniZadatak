<?php
declare(strict_types=1);
namespace App\Model\Project;

use App\Core\DataObjectRepositoryInterface;
use App\Core\Database;

class ProjectRepository implements DataObjectRepositoryInterface{


    public function getList()
    {
        $list=[];
        $db=Database::getInstance();
        $statement=$db->prepare("select id, name_of_project, description_of_project, starting_date, ending_date, completed from project");
        $statement->execute();
        foreach ($statement->fetchAll() as $post){
            $list=new Project([
                'id'=>$post ->id,
                'name_of_project' =>$post->name_of_project,
                'description_of_project' =>$post ->description_of_project,
                'starting_date'=>$post ->starting_date,
                'ending_date'=>$post ->ending_date,
                'completed '=>$post ->completed

            ]);
        }
        return $list;
    }
}
