<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OpmOpSystemNotice */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Opm Op System Notice',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opm Op System Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="opm-op-system-notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
