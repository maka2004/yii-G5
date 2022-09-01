<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LuckyNumber;

class LuckyNumbersController extends Controller
{
    const NUMBER_UNITS = 6;

    /**
     * Displays LuckyNumbers homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $post = $request->post();

        $model = new LuckyNumber();
        $model->load($post);

        $model->validate();

        if (empty($model->errors)) {
            $model->countLuckyNumbers();
        }

        if ($request->isPjax) {
            return $this->renderAjax('index', [
                'model'  => $model,
            ]);
        }
        return $this->render('index', [
            'model'  => $model,
        ]);
    }

}
