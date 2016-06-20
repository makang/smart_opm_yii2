<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Smart Publicsignal Statistics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smart-publicsignal-statistics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
    ]); ?>
</div>
