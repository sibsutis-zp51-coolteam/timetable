<?php

/**
 * Подключение классов
 *
 * @param string $className
 */
spl_autoload_register(function ($className) {
    $fileName = $className;
    $fileName = preg_replace('/\\\\/', '/', $fileName);
    $fileName = __DIR__ . DIRECTORY_SEPARATOR . $fileName . '.php';

    if (file_exists($fileName)) {
        return require $fileName;
    }
});

if (!file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    throw new Exception('You must run "composer install" before launch anything');
}

require dirname(__DIR__) . '/vendor/autoload.php';

$client = new Raven_Client('https://47e095142a5e46fe972a306e33bd05cf:8489a897111e412e8dc9fb79bb68be50@sentry.io/122209');
$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();

