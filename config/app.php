<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 15:21
 *
 * Application config
 */

return [
    'route' => [
        'class' => 'app\Route',
        'errorRule' => 'index/error',
        'controllersNamespace' => 'app\controllers',
        'routeRules' => [
            '' => 'index/index',
        ],
    ],
    'db' => [
        'class' => 'app\DB',
        'name' => 'english_dom',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
    ],
];
