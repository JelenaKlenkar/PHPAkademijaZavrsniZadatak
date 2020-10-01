<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Exception\RouterException;

class Router implements RouterInterface
{
    public function match(string $pathInfo)
    {
        $pathInfo = trim($pathInfo, '/');
        $parts = $pathInfo ? explode('/', $pathInfo) : [];

        if (count($parts) > 2) {
            throw new RouterException('Not valid URL');
        }

        $controller = ucfirst(strtolower($parts[0] ?? 'home')) . 'Controller';
        $method = strtolower($parts[1] ?? 'index') . 'Action';

        $className = "\\App\\Controller\\{$controller}";

        if (!method_exists($className, $method)) {
            throw new RouterException('Method does not exist');
        }

        $object = new $className();
        return $object->$method() ?? '';
    }
}