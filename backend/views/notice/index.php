<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\OpmOpSystemNotice;
use yii\widgets\ActiveForm;

$this->title = '影院公告列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="/assets_ace/css/chosen.css" />
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加公告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'编号','value'=>'id'],
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
               'template' => '{view} {update} {delete}',
               'headerOptions' => ['width' => '170'],
               
           ],
        ],
    ]); ?>
</div>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>