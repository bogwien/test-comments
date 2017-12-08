<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 16:36
 *
 * @var $comments
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
    <h1>Comments</h1>

    <div class="comment-form-wrap">
        <form action="/" method="post">
            <div class="input-wrap">
                <label for="name-input">Name</label>
                <input id="name-input" type="text" name="Comment[name]">
            </div>
            <div class="input-wrap">
                <label for="text-input">Text</label>
                <textarea id="text-input" name="Comment[text]"></textarea>
            </div>
            <button type="submit">Send</button>
        </form>
    </div>

    <div class="comments">
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <h3><?= $comment['name'] ?> at <?= date('d.m.Y H:i:s', $comment['created_at']) ?></h3>
                <p><?= $comment['text'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>