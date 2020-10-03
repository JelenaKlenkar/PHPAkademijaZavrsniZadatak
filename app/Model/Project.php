<?php


namespace App\Model;


class Project extends AbstractModel
{
    protected static $tableName = 'project';
    protected static function createObject(array $data): AbstractModel
    {
        $project = User::getAll();
        return parent::createObject($data);
    }
}
{

}