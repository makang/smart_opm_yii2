<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', '订单统计');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<link rel="stylesheet" href="/assets_ace/css/chosen.css"/>
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">

            <div class="row">
                <div class="col-sm-10">
                    <div id="sample-table-2_length" class="dataTables_length">

                        <?php $form = ActiveForm::begin([
                            'action' => ['order'],
                            'method' => 'get',
                        ]); ?>
                        <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers_start" readonly name="start_date" class="search-query"
                                   placeholder="开始日期"
                                   value="<?= !empty($_REQUEST['start_date']) ? $_REQUEST['start_date'] : ""; ?>"/>
                        </span>
                         <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers_end" readonly name="end_date" class="search-query"
                                   placeholder="结束日期"
                                   value="<?= !empty($_REQUEST['end_date']) ? $_REQUEST['end_date'] : ""; ?>"/>
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
                'pager' => [
                    //'options'=>['class'=>'hidden']//关闭分页
                    'firstPageLabel' => "第一页",
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页',
                    'lastPageLabel' => '最后一页',
                ],
                'columns' => [
                    ['label' => '日期', 'format'=>'html', 'value' => function($row){
                        return Html::a($row['order_day'],
                            ['list', 'day'=> $row['order_day']],
                            [
                                'class' => 'btn btn-xs btn-warning confirm',
                            ]
                        );
                    }],
                    ['label' => '出票数', 'value' => 'ticket_num'],
                    ['label' => '订单数', 'value' => 'order_num'],
                    ['label' => '订单额', 'value' => function ($row) {
                        return $row['pay_money'] / 100;
                    }],
                    ['label' => '会员出票数', 'value' => function($row){
                       return sprintf("%2d", $row['member_num']/$row['ticket_num']*100)."%  | ".$row['member_num'];
                     }],
                    ['label' => '服务费', 'value' => function ($row) {
                        return $row['total_fee'] / 100;
                    }],
                    ['label' => '卖品订单数', 'value' => 'suits_order_totals'],
                    ['label' => '卖品销售额', 'value' => function ($row) {
                        return $row['suits_order_money_totals'] / 100;
                    }],
                ],
            ]); ?>


        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>
<link rel="stylesheet" href="/assets_ace/css/bootstrap-timepicker.css" />
<script src="/assets_ace/js/date-time/bootstrap-timepicker.min.js"></script>


<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<link rel="stylesheet" href="/assets_ace/css/date-time/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>

<link rel="stylesheet" href="/assets_ace/css/datepicker.css" />
<script src="/assets_ace/js/date-time/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#datepickers_start").datepicker({
            format: "yyyy-mm-dd",
            language:  'zh-CN',
            autoclose:'true'
        })
        $("#datepickers_end").datepicker({
            format: "yyyy-mm-dd",
            language:  'zh-CN',
            autoclose:'true'
        });


        $(".chosen-select").chosen();
    });

</script>


