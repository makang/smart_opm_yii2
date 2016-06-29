<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Article;
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
                            'action' => ['details'],
                            'method' => 'get',
                        ]); ?>

                        <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers" name="start_date" class="search-query datepicker" placeholder="开始日期" value="<?= !empty($_REQUEST['start_date'])?$_REQUEST['start_date']:"";?>"/>
                        </span>
                        <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickere" name="end_date" class="search-query datepicker" placeholder="结束日期" value="<?= !empty($_REQUEST['end_date'])?$_REQUEST['end_date']:"";?>"/>
                        </span>


                        <div class="btn-group">
                            <input type="hidden" name="cinema_no" value="<?= $_REQUEST['cinema_no'];?>">
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
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label'=>'状态',
                        'format' => 'html',
                        'value'=>function($row){
                        return \backend\models\SmartSingleOrder::model()->sOrderStatus($row['status']);
                    }],
                    ['label'=>'op订单号','value'=>'orderid'],
                    [
                        'label'=>'op金额',
                        'value'=>function($row){return ($row['pay_money']/100);}
                    ],
                    [
                        'label'=>'时间',
                        'format' => ['date', 'php:Y-m-d'],
                        'value'=>'dateline'
                    ],
                    ['label'=>'微信账号','value'=>'wxAccount'],
                    ['label'=>'微信订单号','value'=>'wxOrder'],
                    ['label'=>'微信商户单号','value'=>'wxOrderMid'],
                    ['label'=>'微信支付金额','value'=>'wxMoney'],
                    ['label'=>'微信手续费','value'=>'wxFee'],
                    ['label'=>'微信退款金额','value'=>'wxRefundMoney'],
                    ['label'=>'微信退款手续费','value'=>'wxRefundFee'],
                    ['label'=>'商品名称','value'=>'wxName'],

                ],
            ]); ?>




        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>
<link rel="stylesheet" href="/assets_ace/css/datepicker.css" />
<script src="/assets_ace/js/date-time/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>


<script type="text/javascript">
    jQuery(function($) {

        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            language:  'zh-CN',
            autoclose:'true'
        })


        $(".chosen-select").chosen();
    });



</script>



