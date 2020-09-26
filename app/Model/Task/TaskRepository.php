<?php
declare(strict_types=1);

namespace App\Model\Task;

use App\Core\DataObjectRepositoryInterface;
use App\Core\Database;

class TaskRepository implements DataObjectRepositoryInterface
{

    public function getList()
    {
        $list=[];
        $db=Database::getInstance();
        $statement=$db->prepare("select id, description, closed from task");
        $statement->execute();
        foreach ($statement->fetchAll() as $post){
            $list=new Task([
                'id'=>$post ->id,
                'description' =>$post->description,


            ]);
        }
        return $list;
    }
}
