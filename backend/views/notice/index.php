<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\OpmOpSystemNotice;

$this->title = '影院公告列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加公告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin();
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'filter' => Html::activeDropDownList($searchModel,
                    'status',[0=>'未发布',1=>'已发布',2=>'删除',3=>'已结束'],
                    ['prompt'=>'全部','class'=>'form-control']
                ),
                'headerOptions' => ['width' => '100']
            ],
            'creatTime',
            'upTime',
            'uid',
            'uname',
           ['class' => 'yii\grid\ActionColumn','header' => '操作',],
        ],
    ]); ?>
<?php Pjax::end();
    // ActiveForm::end();
?></div>
<script src="/assets_ace/js/jquery-2.0.3.min.js"></script>
