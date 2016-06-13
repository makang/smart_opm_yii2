<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OpmOpSystemNotice */

$this->title = Yii::t('app', 'Create Opm Op System Notice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opm Op System Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opm-op-system-notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
