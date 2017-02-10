<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var \yii\web\View      $this
 * @var \app\models\Notice $notice
 */
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Добавить уведомление:</h3>
            </div>

            <?php $form = ActiveForm::begin(); ?>

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

