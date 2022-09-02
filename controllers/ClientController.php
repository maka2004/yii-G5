<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Client;
use app\models\search\ClientSearch;

class ClientController extends Controller
{
    /**
     * Displays Users page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
