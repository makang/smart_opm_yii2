<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', '公众号统计');
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
                            'action' => ['statistic'],
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
                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="publicsignalname" class="search-query" placeholder="公众号名称"
                                   value="<?= !empty($_REQUEST['publicsignalname']) ? $_REQUEST['publicsignalname'] : '' ?>"/>
                        </span>
                        <span class="input-icon align-middle" style="width: 200px">

                            <select class="width-100 chosen-select" name="orderby" data-placeholder="选择排序">
                                <option value="" <?php echo empty($_REQUEST['orderby']) ? 'selected' : '' ?>>默认排序</option>
                                <option value="total_sales" <?php echo (!empty($_REQUEST['orderby'])&&$_REQUEST['orderby']=='total_sales') ? 'selected' : '' ?>>销售额</option>
                                <option value="total_orders" <?php echo (!empty($_REQUEST['orderby'])&&$_REQUEST['orderby']=='total_orders') ? 'selected' : '' ?>>订单数</option>
                                <option value="new_user" <?php echo (!empty($_REQUEST['orderby'])&&$_REQUEST['orderby']=='new_user') ? 'selected' : '' ?>>新增粉丝数</option>
                                <option value="cumulate_user" <?php echo (!empty($_REQUEST['orderby'])&&$_REQUEST['orderby']=='cumulate_user') ? 'selected' : '' ?>>累计粉丝数</option>
                                <option value="publicsignalshort" <?php echo (!empty($_REQUEST['orderby'])&&$_REQUEST['orderby']=='publicsignalshort') ? 'selected' : '' ?>>公众号</option>
                            </select>
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
                    ['label' => '公众号名称', 'value' => 'publicsignalname'],
                    ['label' => '新增粉丝数', 'value' => 'new_user'],
                    ['label' => '取消粉丝数', 'value' => 'cancel_user'],
                    ['label' => '净增粉丝数', 'value' => 'increase_user'],
                    ['label' => '累计粉丝数', 'value' => 'cumulate_user'],
                    ['label' => '订单数', 'value' => 'total_orders'],
                    ['label' => '销售额', 'value' => 'total_sales'],
                    ['label' => '卖品订单数', 'value' => 'suits_order_totals'],
                    ['label' => '卖品销售额', 'value' => 'suits_order_money_totals'],
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


