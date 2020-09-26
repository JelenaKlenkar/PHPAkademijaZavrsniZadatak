<?php
declare(strict_types=1);
namespace App\Model\JobPosition;

use App\Core\DataObjectRepositoryInterface;
use App\Core\Database;

class JobPositionRepository implements DataObjectRepositoryInterface
{

    public function getList()
    {
        $list=[];
        $db=Database::getInstance();
        $statement=$db->prepare("select id,job_position,job_position_description from job_position");
        $statement->execute();
        foreach ($statement->fetchAll() as $post){
            $list=new JobPosition([
              'id'=>$post ->id,
              'name_of_job_position' =>$post->name_of_job_position,
              'job_position_description' =>$post ->job_position_description
            ]);
        }
        return $list;
    }
}
