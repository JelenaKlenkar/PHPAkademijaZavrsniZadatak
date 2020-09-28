<?php
namespace App\Core;

use App\Exception\RouterException;

class Router implements RouterInterface
{
    public const URL_SUFFIX = '.html';

    public function match(string $pathInfo)
    {
        $pathInfo = trim($pathInfo, '/');
        $pathInfo = str_replace(self::URL_SUFFIX, '', $pathInfo);
        $parts = $pathInfo ? explode('/', $pathInfo) : [];

        if (count($parts) > 2) {
            throw new RouterException("Not valid URL: {$pathInfo}");
        }

        $controller = ucfirst(strtolower($parts[0] ?? 'home')) . 'Controller';
        $method = strtolower($parts[1] ?? 'index') . 'Action';

        $className = "\\App\\Controller\\{$controller}";

        if (!method_exists($className, $method)) {
            throw new RouterException("Method doesn't exist : {$className}::$method");
        }

        $object = new $className();
        return $object->$method() ?? '';
    }
}