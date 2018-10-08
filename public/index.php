<?php

date_default_timezone_set('UTC');

require __DIR__ . '/../vendor/autoload.php';

use Cottect\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

$isDevEnvironment = $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'));

try {
    // The check is to ensure we don't use .env in production
    if (!isset($_SERVER['APP_ENV'])) {
        (new Dotenv())->load(__DIR__ . '/../.env');
    }
    if ($isDevEnvironment) {
        umask(0000);
        Debug::enable();
    }
    $kernel = new Kernel(
        $_SERVER['APP_ENV'] ?? 'dev',
        $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'))
    );
    $request = Request::createFromGlobals();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
} catch (Exception $e) {
    if ($isDevEnvironment) {
        print $e;
    }
    echo '<html><!--' . date('Y-m-d H:i:s', time()) . '--></html>';
}
