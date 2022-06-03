<?php

namespace app\controllers;

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

        $from = $post['from'] ?? 0;
        $to = $post['to'] ?? 0;

        $data = [
            'from' => $from,
            'to' => $to,
            'counter' => self::getLuckyNumbersCounter($from, $to)
        ];

        if ($request->isPjax) {
            return $this->renderAjax('index', [
                'data'  => $data,
            ]);
        }
        return $this->render('index', [
            'data'  => $data,
        ]);
    }

    public static function getLuckyNumbersCounter($from, $to): int
    {
        if ($from > $to) {
            return 0;
        }
        $counter = 0;

        for ($i = $from; $i <= $to; $i++) {
            // get left and right part
            $left = self::splitNumber($i)[0];
            $right = self::splitNumber($i)[1];

            // get numbers sum
            $left_counter = self::getDigitsSum($left);
            $right_counter = self::getDigitsSum($right);

            // compare and set counter
            if ($left_counter == $right_counter) {
                $counter++;
            }
        }
        return $counter;
    }

    public static function splitNumber(int $number): array
    {
        $str = self::getProperStringFormat($number);
        $left_part = substr($str, 0, 3);
        $right_part = substr($str, 3, 3);

        return [$left_part, $right_part];
    }

    public static function getProperStringFormat(int $number): string
    {
        $str = (string)$number;
        while (count(str_split($str)) < self::NUMBER_UNITS) {
            $str = '0' . $str;
        }

        return $str;
    }

    public static function getDigitsSum(string $str_number): int
    {
        $arr = str_split($str_number);

        $result = 0;
        foreach ($arr as $item)
        {
            $result += $item;
        }

        if ($result > 9) {
            $result = self::getDigitsSum((string)$result);
        }

        return $result;
    }
}
