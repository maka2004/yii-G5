<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Client;
use app\models\Shop;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */

$this->title = 'Client';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
        <div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    [
                        'attribute' => 'sex',
                        'format'    => 'text',
                        'content' => function ($model) {
                            if ($model->sex == Client::SEX_MALE) {
                                return 'male';
                            } elseif ($model->sex == Client::SEX_MALE) {
                                return 'female';
                            }
                        },
                    ],
                    'email',
                    'pin',
                    [
                        'attribute' => 'date_of_birth',
                        'format'    => 'text',
                        'content' => function ($model) {
                            return date('d-m-Y', $model->date_of_birth);
                        },
                    ],
                    [
                        'attribute' => 'shop',
                        'format'    => 'text',
                        'content' => function ($model) {
                            return Html::a(yii::t('app', $model->shop->name), ['shop/view', 'id' => $model->shop->id], ['data-pjax' => 0]) . ' ';
                        },
                        'filter' => ArrayHelper::map(Shop::find()->all(), 'id', 'name'),
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/client/view?id=' . $model->id, [
                                    'title' => 'View',
                                    'data-pjax' => '0',
                                ]);
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>

    <code><?= __FILE__ ?></code>
</div>
