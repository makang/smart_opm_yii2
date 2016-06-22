<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Article;
use backend\models\SmartCinema;
use yii\widgets\ActiveForm;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">

            <div class="row">
                <div class="col-sm-10">
                    <div id="sample-table-2_length" class="dataTables_length">

                        <?php $form = ActiveForm::begin([
                            'action' => ['list'],
                            'method' => 'get',
                        ]); ?>


                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="cinema_no" class="search-query" placeholder="影院名称|影院编号" value="<?= !empty($_REQUEST['cinema_no'])?$_REQUEST['cinema_no']:'' ?>"/>
                        </span>



                            <div class="btn-group">

                            </div>
                            <span></span>
                            <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= Html::a('批量新增',['add'], ['class' => 'btn btn-sm btn-info']) ?>
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

                    ['label'=>'影院ID','value'=>'cinema_no'],
                    ['label'=>'影院名称','value'=>function($row){
                        $ret = SmartCinema::findOne(['cinemaNo'=>$row->cinema_no]);
                        return $ret->CinemaName;
                    }],

                    ['label'=>'公众号','value'=>function($row){
                        $ret = \backend\models\SmartPublicSignal::findOne(['pid'=>$row->pid]);
                        return $ret->PublicSignalNickname;
                    }],
                    ['label'=>'售票系统','value'=>function($row){
                        return \backend\models\SmartCinemaPersonalConfig::$_BOOKINGSYSTEM_DESC[$row['ticket_system']];
                    }],
                    ['label'=>'会员手续费','value'=>function($row){
                        return ($row['booking_system_fee']+$row['open_system_fee']+$row['cinema_fee'])/100;
                    }],
                    ['label'=>'订单展示码','value'=>'suit_code_enc'],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{edit} {detail} {log}',
                        'headerOptions' => ['width' => '270'],
                        'buttons' => [
                            'edit' => function($url, $row, $key){
                                return Html::a('编辑',
                                    ['edit', 'id' => $row['id']],
                                    [
                                        'class' => 'btn btn-xs btn-success',
                                    ]
                                );

                            },
                            'detail' => function($url, $row, $key){
                                return Html::a('详情',
                                    ['detail', 'id' =>$row['id']],
                                    [
                                        'class' => 'btn btn-xs btn-primary',
                                    ]
                                );

                            }
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


<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click','.confirm',function(){
            var res = confirm('确定吗？亲');
            return res;
        });

    });



</script>


<div id="dialog-confirm" class="hide">
    <div class="alert alert-info bigger-110">
       一旦删除则永久不能回复
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        确定删除？
    </p>
</div><!-- #dialog-confirm -->



