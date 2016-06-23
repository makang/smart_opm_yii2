<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\OpmOpSystemNotice;

$this->title = '影院公告列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/assets_ace/css/chosen.css" />
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加公告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'url',
            [
                'attribute' =>'status',
                'label'=>'状态',
                'value'=>function($model){
                    $arr=[0=>'未发布',1=>'已发布',2=>'删除',3=>'已结束'];
                    if(isset($model->status)){
                        return $arr[$model->status];
                    }else{
                        return "";
                    }
                },
                'headerOptions' => ['width' => '100']
            ],
            'creatTime',
            'upTime',
            'uid',
            'uname',
           [
               'class' => 'yii\grid\ActionColumn',
               'header' => '操作',
               'template' => '{view} {update} {delete}',//只需要展示删除和更新
               'headerOptions' => ['width' => '170'],
               'buttons' => [
                   'detail' => function($url, $model, $key){
                       return Html::a('查看',
                           ['view', 'date' => $model->id],
                           [
                               'class' => 'btn btn-xs btn-success',
                           ]
                       );
                   },
                   'collate' => function($url, $model, $key){
                       return Html::a('编辑',
                           ['update', 'date' => $model->id],
                           [
                               'class' => 'btn btn-xs btn-info',
                           ]
                       );
                   },
                   'download' => function($url, $model, $key){
                       return Html::a('删除',
                           ['delete', 'date' => $model->id],
                           [
                               'class' => 'btn btn-xs btn-warning',
                           ]
                       );
                   },
               ],
           ],
        ],
    ]); ?>
</div>
