<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OpmOpSystemNotice */
/* @var $form ActiveForm */
?>
<div class="notice-lists">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'url') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'uid') ?>
        <?= $form->field($model, 'upuid') ?>
        <?= $form->field($model, 'creatTime') ?>
        <?= $form->field($model, 'upTime') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'uname') ?>
        <?= $form->field($model, 'upuname') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- notice-lists -->
