<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use app\models\LuckyNumber;

class ClientController extends Controller
{
    /**
     * Displays Users page.
     *
     * @return string
     */
    public function actionIndex()
    {
//        die(Yii::$app->params['db_name']);
//        echo getenv('DB_NAME'); die();
        return json_encode(Yii::$app->params);
    }

}
