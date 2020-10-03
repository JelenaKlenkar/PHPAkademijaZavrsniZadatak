<?php


namespace App\Model;


class Task extends AbstractModel
{
    protected static $tableName = 'task';
    protected static function createObject(array $data): AbstractModel
    {
        $task = User::getAll();
        return parent::createObject($data);
    }
}
{

}