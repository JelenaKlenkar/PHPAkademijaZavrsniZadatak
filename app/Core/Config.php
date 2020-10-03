<?php
declare(strict_types=1);
namespace App\Core;


class Config{

    public static function get(string $key)
    {
        $config = include BP . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php';

        return $config[$key] ?? null;
    }
}
