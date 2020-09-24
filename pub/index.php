<?php

define('BP', dirname(__DIR__));

// autoloader
spl_autoload_register(function ($class) {
    $class = lcfirst($class);
    $filename = BP . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($filename)) {
        require_once $filename;
    }
});

$router = new \App\Core\Router();
$application = new \App\Core\Application($router);

try {
    $response = $application->run();
} catch (\App\Exception\RouterException $e) {
    $response = '<h1>404</h1>';
} catch (\Exception $e) {
    $response = '<h1>500</h1>';
}

echo $response;
