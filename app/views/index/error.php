<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 16:36
 *
 * @var $e \app\HttpException
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error #<?= $e->statusCode ?></title>
</head>
<body>
<h1><?= $e->getMessage() ?></h1>
</body>
</html>

