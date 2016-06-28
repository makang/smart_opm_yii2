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
                            <input type="text" id="datepickers_start" name="start_date" class="search-query"
                                   placeholder="开始日期"
                                   value="<?= !empty($_REQUEST['start_date']) ? $_REQUEST['start_date'] : ""; ?>"/>
                        </span>
                         <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers_end" name="end_date" class="search-query"
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
                    ['label' => '会员出票数', 'value' => 'member_num'],
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

<script type="text/javascript">
    jQuery(function ($) {
        $("#datepickers_start").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm-dd",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        })
        $("#datepickers_start").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm-dd",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        });


        $(".chosen-select").chosen();
    });


</script>
<script type="text/javascript">
    jQuery(function ($) {
        $("#datepickers_end").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm-dd",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        })
        $("#datepickers_end").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm-dd",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        });


        $(".chosen-select").chosen();
    });


</script>


