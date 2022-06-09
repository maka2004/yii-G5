<?php

namespace app\controllers;

use app\models\LuckyNumber;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class LuckyNumbersController extends Controller
{
    const NUMBER_UNITS = 6;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

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
