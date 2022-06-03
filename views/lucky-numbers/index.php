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
            echo Html::beginForm(Url::to(['lucky-numbers/index']), 'POST', ['data-pjax' => 0]);
        ?>
        <div class="table">
            <div class="float">
                <?= Html::label('N - from', 'from'); ?>
                <?= Html::input(
                    'number',
                    'from',
                    $data['from'] ?? null,
                    ['min' => 0, 'max' => 999999, 'class' => 'form-control']
                ); ?>
            </div>
            <div class="float">
                <?= Html::label('N - to', 'from'); ?>
                <?= Html::input(
                        'number',
                        'to',
                        $data['to'] ?? null,
                        ['min' => 0, 'max' => 999999, 'class' => 'form-control']
                ); ?>
            </div>
            <div class="float submitter">
                <?= Html::input('submit', 'submit-btn', 'Run', ['class' => 'btn btn-primary']); ?>
            </div>
        </div>

        <p>
            <label>
                <span><b>Number of tickets: </b></span>
                <?php echo Html::tag('span', Html::encode($data['counter'] ?? null), ['class' => 'result', 'data-pjax' => 1]); ?>
            </label>
        </p>

        <?php
            Html::endForm();
            Pjax::end();
        ?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
