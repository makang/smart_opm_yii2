<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SmartPublicsignalStatistics */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Smart Publicsignal Statistics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smart-publicsignal-statistics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'publicsignalshort',
            'publicsignalname',
            'new_user',
            'cancel_user',
            'increase_user',
            'cumulate_user',
            'total_orders',
            'total_sales',
            'suits_order_totals',
            'suits_order_money_totals',
            'create_time',
        ],
    ]) ?>

</div>
