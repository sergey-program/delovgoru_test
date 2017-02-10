<?php

use app\components\DateFilter;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View                $this
 * @var \app\models\Notice           $notice
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var DateFilter                   $dateFilter
 */
?>

<div class="row">
    <div class="col-md-8">

        <?php Pjax::begin(['id' => 'notices', 'enablePushState' => true]); // leave url to demonstrate ajax ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Список за месяц:</h3>
            </div>

            <div class="panel-body">
                <p class="alert text-center">
                    <a href="<?= Url::to(['notice/index', 'y' => $dateFilter->getPrev('y'), 'm' => $dateFilter->getPrev('m')]); ?>" class="btn btn-default pull-left">
                        <i class="fa fa-arrow-left"></i> <?= $dateFilter->getPrev(); ?>
                    </a>

                    <span style="line-height: 34px;"><strong><?= $dateFilter->y; ?>-<?= $dateFilter->m; ?></strong></span>

                    <a href="<?= Url::to(['notice/index', 'y' => $dateFilter->getNext('y'), 'm' => $dateFilter->getNext('m')]); ?>" class="btn btn-default pull-right">
                        <?= $dateFilter->getNext(); ?> <i class="fa fa-arrow-right"></i>
                    </a>
                </p>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'oncreate:datetime',
                        'message',
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => \Yii::t('yii', 'Delete'),
                                        'data-confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'data-method' => 'post',
                                        'data-pjax' => '#notices',
                                    ]);
                                }
                            ]
                        ]
                    ]
                ]); ?>

            </div>
        </div>

        <?php Pjax::end(); ?>
    </div>

    <div class="col-md-4">

        <?php $flash = explode(':', \Yii::$app->session->getFlash('notice-create', ':')); ?>
        <?php if ($flash[0]): ?>
            <p class="alert alert-<?= $flash[0]; ?> text-center"><?= $flash[1]; ?></p>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Добавить уведомление:</h3>
            </div>

            <?php $form = ActiveForm::begin(['action' => Url::to(['create'])]); ?>

            <div class="panel-body">
                <?= $form->field($notice, 'message')->textarea(['placeholder' => 'Напишите пару слов...']); ?>
            </div>

            <div class="panel-footer text-center">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>
