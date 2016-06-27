<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\SmartSuits;
use backend\models\SmartSuitOrder;

$this->title = Yii::t('app', '电影订单');
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
                            <input type="text" id="datepickers_start" name="start_date" class="search-query datetimepicker"
                                   placeholder="开始日期"
                                   value="<?= !empty($_REQUEST['start_date']) ? $_REQUEST['start_date'] : date('Y-m-d H:i:s',time()-2*24*60*60); ?>"/>
                        </span>
                         <span class="input-icon align-middle">
                            <i class="icon-calendar"></i>
                            <input type="text" id="datepickers_end" name="end_date" class="search-query datetimepicker"
                                   placeholder="结束日期"
                                   value="<?= !empty($_REQUEST['end_date']) ? $_REQUEST['end_date'] : date('Y-m-d H:i:s',time()); ?>"/>
                        </span>
                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="suit_id" class="search-query" placeholder="请输入订单编号"
                                   value="<?= !empty($_REQUEST['suit_id']) ? $_REQUEST['suit_id'] : '' ?>"/>
                        </span>
                        <span class="input-icon align-middle" style="width: 200px">

                            <select class="width-100" name="status">
                                  <option value="all" >全部状态</option>
                                <?php
                                foreach($dataStatus as $k=>$v){
                                    $k = $k."";
                                    $selected=(isset($_REQUEST['status'])&&($_REQUEST['status']==$k))?'selected':'';
                                    echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                }
                                ?>
                            </select>
                        </span>
                        <span class="input-icon align-middle" style="width: 200px">

                            <select class="width-100 chosen-select" name="discountType">
                                  <option value="">使用优惠</option>
                                <?php
                                foreach ($discountType as $k => $v) {
                                    $k = $k."";
                                    $selected=(isset($_REQUEST['status'])&&($_REQUEST['status']==$k))?'selected':'';
                                    echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
                                }
                                ?>
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
                    ['label' => '订单号', 'value' => 'orderid'],
                    ['label' => '影院名称', 'value' => function ($row) {
                        return $row['smart_schedule']['cinema_name'];
                    }],
                    ['label' => '商品信息', 'value' => function ($row) {
                        return "《" . $row['smart_schedule']['movie_name'] . "》 " . $row['ticket_num'] . '张';
                    }],
                    ['label' => '购买时间', 'value' => function ($row) {
                        return date('Y-m-d H:i:s', $row['dateline']);
                    }],
//                    ['label' => '卖品', 'value' => function ($row) {
//                        return $row['isSuit'] ? '是' : '无';
//                    }],
                    ['label' => '原价', 'value' => function ($row) {
                        return $row['total_money'] / 100;
                    }],
                    ['label' => '优惠类型', 'value' => function ($row) {
                        $discountType = $row['discount_type'];
                        return \backend\models\SmartOrders::getDiscountType()[$discountType];
                    }],
//                    ['label' => '优惠金额', 'value' => 'discount_money'],
                    ['label' => '实际支付', 'value' => function ($row) {
                        return $row['pay_money'] / 100;;
                    }],
//                    ['label' => '支付方式', 'value' => function ($row) {
//                        if ($row['pay_type'] == 2)
//                            return '会员卡';
//                        else
//                            return '微信支付';
//                    }],
                    ['label' => '订单状态', 'value' => function ($row) {
                        return \backend\models\SmartOrders::getStatus()[$row['status']];
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
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>
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

    $('.datetimepicker').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    //        //日历选择
    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        language:  'zh-CN',
        autoclose:'true'
    })

</script>


