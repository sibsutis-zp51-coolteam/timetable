#!/usr/bin/env php
<?php

require __DIR__ . '/bootstrap.php';

$arguments = call_user_func(function() use ($argv) {
    $last = null;
    $arguments = ['controller' => 'ControllerDefault'];

    foreach ($argv as $argument) {
        if (in_array($last, ['--controller'])) {
            $last = preg_replace('#--([a-z_0-9]+)#', '$1', $last);
            $arguments[$last] = $argument;
        }

        $last = $argument;
    }

    return $arguments;
});

$controllerName = 'Controller\\' . str_replace('_', '\\', $arguments['controller']);
echo $controllerName;
if (!class_exists($controllerName)) {
    throw new Exception('Неизвестный контроллер ' . $controllerName);
}

$controller = new $controllerName();
$controller->run();

