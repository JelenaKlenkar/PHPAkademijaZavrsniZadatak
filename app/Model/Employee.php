<?php


namespace App\Model;


class Employee extends AbstractModel
{
protected static $tableName = 'employee';
protected static function createObject(array $data): AbstractModel
{
  $employee = User::getAll();
  return parent::createObject($data);
}
}