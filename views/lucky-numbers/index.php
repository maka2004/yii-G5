<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Lucky Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Push in your chips.
    </p>

    <p>
        <?php
            Pjax::begin();
            echo Html::beginForm(Url::to(['lucky-numbers/index']), 'POST', ['data-pjax' => 0, 'name' => 'l-numbers']);
        ?>
        <div class="table">
            <div class="float">
                <?= Html::label('N - from', 'from'); ?>
                <?= Html::activeInput(
                    'number',
                    $model,
                    'from',
                    ['class' => 'form-control']
                ); ?>
            </div>
            <div class="float">
                <?= Html::label('N - to', 'to'); ?>
                <?= Html::activeInput(
                    'number',
                    $model,
                    'to',
                    ['class' => 'form-control']
                ); ?>
            </div>
            <div class="float submitter">
                <?= Html::input('submit', 'submit-btn', 'Run', ['class' => 'btn btn-primary']); ?>
            </div>
        </div>

        <p>
            <label>
                <span><b>Number of tickets: </b></span>
                <?php echo Html::tag('span', Html::encode($model->counter), ['class' => 'result', 'data-pjax' => 1]); ?>
            </label>
        </p>

        <p class="errors">
            <?php
            foreach ($model->errors ?? null as $key => $attribute) {
                foreach ($attribute as $error) {
                    echo Html::tag('span', $error);
                }
            }
            ?>
        </p>

        <?php
            Html::endForm();
            Pjax::end();
        ?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
