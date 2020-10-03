<?php


namespace App\Model;


class Team extends AbstractModel
{
    protected static $tableName = 'team';
    protected static function createObject(array $data): AbstractModel
    {
        $team = User::getAll();
        return parent::createObject($data);
    }
}
{

}