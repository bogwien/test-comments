<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 15:49
 */

namespace app\controllers;

use app\Controller;
use app\HttpException;
use app\models\Comments;
use app\models\EventList;

/**
 * Class Index
 * @package app\controllers
 */
class Index extends Controller
{
    /**
     * Action index
     */
    public function index()
    {
        $comments = Comments::getAll();
        if ($_POST && isset($_POST['Comment'])) {
            $model = new Comments([
                'name' => empty($_POST['Comment']['name']) ? null : trim(strip_tags($_POST['Comment']['name'])),
                'text' => empty($_POST['Comment']['text']) ? null : trim(strip_tags($_POST['Comment']['text'])),
            ]);

            global $app;
            if ($model->validate()) {
                $app->eventManager->trigger(EventList::ON_SUBMIT, $this, ['model' => $model]);
                header("Location: /");
                die();
            }
        }

        $this->render('index', compact('comments'));
    }

    /**
     * Error action
     * @param HttpException $e
     */
    public function error(HttpException $e)
    {
        $this->render('error', compact('e'));
    }
}
