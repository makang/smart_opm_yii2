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
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>

                        <span class="input-icon align-middle" style="width: 200px">

                            <select class="width-100 chosen-select" name="pid" data-placeholder="选择商户">
                                <option value="">请选择商户</option>
                                <?php
                                    foreach($publicSignal as $k=>$v){
                                        echo '<option value="'.$k.'">'.$v.'</option>';
                                    }
                                ?>

                            </select>
                        </span>
                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="cinema_no" class="search-query" placeholder="影院名称|影院编号" value="<?= !empty($_REQUEST['cinema_no'])?$_REQUEST['cinema_no']:'' ?>"/>
                        </span>

                        <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers" name="start_date" class="search-query" placeholder="开始日期" value="<?= !empty($_REQUEST['start_date'])?$_REQUEST['start_date']:"";?>"/>
                        </span>



                            <div class="btn-group">

                            </div>
                            <span></span>
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
                    ['label'=>'影院','value'=>function($m){
                        $ret = SmartCinema::find()->where(['cinemaNo' => $m->cinema_no])->one();
                        return $ret->CinemaName;
                    }],
                    ['label'=>'总订单数','value'=>'order_num'],
                    ['label'=>'总金额','value'=>function($row){
                        return ($row['order_money']/100);
                    }],
                    ['label'=>'票数量','value'=>'ticket_num'],
                    ['label'=>'票金额','value'=>function($row){
                        return ($row['ticket_money']/100);
                    }],
                    ['label'=>'卖品数量','value'=>'suit_num'],
                    ['label'=>'卖品金额','value'=>function($row){
                        return ($row['suit_money']/100);
                    }],
                    ['label'=>'退款数量','value'=>'refund_num'],
                    ['label'=>'退款金额','value'=>function($row){
                        return ($row['refund_money']/100);
                    }],
                    ['label'=>'充值数量','value'=>'enc_num'],
                    ['label'=>'充值金额','value'=>function($row){
                        return ($row['enc_money']/100);
                    }],
                    ['label'=>'会员订单数','value'=>'mem_num'],
                    ['label'=>'会员金额','value'=>function($row){
                        return ($row['mem_money']/100);
                    }],
                    ['label'=>'入账总额','value'=>function($row){
                        $item = '总营收：'.($row['ticket_money']+$row['suit_money']+$row['enc_money']-$row['refund_money']+$row['mem_money'])/100;
                        return $item;
                    }],
                    ['label'=>'手续费','value'=>function($row){
                        $item = '手续费：'.($row['order_fee']+$row['ticket_fee']+$row['suit_fee']+$row['refund_fee']+$row['enc_fee']+$row['mem_fee'])/100;
                        return $item;
                    }],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{detail} {collate} {download}',//只需要展示删除和更新
                        'headerOptions' => ['width' => '170'],
                        'buttons' => [
                            'detail' => function($url, $model, $key){
                                return Html::a('详情',
                                    ['details', 'date' => $model->date,'pid'=>$model->pid,'cinema_no'=> $model->cinema_no],
                                    [
                                        'class' => 'btn btn-xs btn-success',
                                    ]
                                );
                            },
                            'collate' => function($url, $model, $key){
                                return Html::a('对账',
                                    ['collate', 'date' => $model->date,'cinema_no'=> $model->cinema_no],
                                    [
                                        'class' => 'btn btn-xs btn-info',
                                    ]
                                );
                            },
                            'download' => function($url, $model, $key){
                                return Html::a('下载',
                                    ['download', 'date' => $model->date,'cinema_no'=> $model->cinema_no],
                                    [
                                        'class' => 'btn btn-xs btn-warning',
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


<script type="text/javascript">
    jQuery(function($) {
        $("#datepickers").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat:"yy-mm",
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            dayNamesMin: ['日','一','二','三','四','五','六']
        })
        $("#datepickere").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat:"yy-mm",
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            dayNamesMin: ['日','一','二','三','四','五','六']
        });


        $(".chosen-select").chosen();
    });



</script>



