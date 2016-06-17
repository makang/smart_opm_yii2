<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\SmartCinema;
use yii\widgets\ActiveForm;
?>



<link rel="stylesheet" href="/assets_ace/css/chosen.css" />
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">

            <div class="row">
                <div class="col-sm-10">
                    <div id="sample-table-2_length" class="dataTables_length">

                        <?php $form = ActiveForm::begin([
                            'action' => ['query'],
                            'method' => 'get',
                        ]); ?>
                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="cinema_no" class="search-query" placeholder="影院名称|影院编号" value="<?= !empty($_REQUEST['cinema_no'])?$_REQUEST['cinema_no']:'' ?>"/>
                        </span>
                        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary']) ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="space-6"></div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}\n{summary}",
                'summary' => '<p class="summary">当前显示第{begin} - {end}条，共{totalCount}条。</p>',
                'pager'=>[
                    //'options'=>['class'=>'hidden']//关闭分页
                    'firstPageLabel'=>"第一页",
                    'prevPageLabel'=>'上一页',
                    'nextPageLabel'=>'下一页',
                    'lastPageLabel'=>'最后一页',
                ],
                'columns' => [
                    ['label'=>'影院编号','value'=>'CinemaNo'],
                    ['label'=>'影院名称','value'=>'CinemaName'],
                    ['label'=>'票务系统','value'=>'TicketSaleSystem'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{detail} {collate} {download}',//只需要展示删除和更新
                        'headerOptions' => ['width' => '170'],
                        'buttons' => [
                            'detail' => function($url, $model, $key){
                                return Html::a('查询排期',
                                    ['query-schedule', 'cinema_no' => $model->CinemaNo,'cinema_name'=>$model->CinemaName],
                                    [
                                        'class' => 'btn btn-xs btn-info',
                                    ]
                                );
                            },
                        ],
                    ]

                ],
            ]); ?>




        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>




