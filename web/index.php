<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 14:29
 *
 * Main application file index.php
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

$projectFolder = dirname(__DIR__);

require $projectFolder . '/vendor/autoload.php';

/**
 * PSR-4 Autoload
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 */
spl_autoload_register(function ($class) use ($projectFolder) {
    $prefix = 'app';
    $base_dir = $projectFolder . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

$config = require $projectFolder . '/config/app.php';

$app = new \app\Application($config);
$app->run();
