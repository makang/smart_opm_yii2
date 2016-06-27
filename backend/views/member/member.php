<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', '会员订单');
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
                            <input type="text" name="cinema_name" class="search-query" placeholder="请输入影院名称"
                                   value="<?= !empty($_REQUEST['cinema_name']) ? $_REQUEST['cinema_name'] : '' ?>"/>
                        </span>
                        <span class="input-icon align-middle" style="width: 200px">

                            <select class="width-100" name="status">
                                  <option value="all" >全部状态</option>
                                <?php
                                foreach($dataStatus as $k=>$v){
                                    $k = $k."";
                                    $selected=(isset($_REQUEST['status'])&&($_REQUEST['status']==$k))?'selected':'';
                                    echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';                                 }
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
                    ['label' => '购买日期', 'value' => 'pay_time'],
                    ['label' => '影院名称', 'value' => function($row){
                        return $row['smart_orders']['smart_schedule']['cinema_name'];
                    }],
//                    ['label' => '创建平台', 'value' => function($row){
//                        var_dump($row['smart_orders']['smart_schedule']['movie_name']);exit();
//                        return ($row==1)?'op':'opm';
//                    }],
                    ['label' => '商品详情', 'value' => function($row){
                            $goodInfo="《".$row['smart_orders']['smart_schedule']['movie_name']."》"." ".$row['smart_orders']['smart_schedule']['hall_name']."  ";
                            $goodInfo.=\backend\models\SmartOrders::formatSeat($row['smart_orders']['seat_info']);

                            return  $goodInfo;

                    }],
                    ['label' => '订单ID', 'value' => 'order_id'],
                    ['label' => '购票数目', 'value' => 'smart_orders.ticket_num'],
                    ['label' => '订单价格', 'value' => function($row){

                        return $row['smart_orders']['pay_money']/100+$row['price'];
                    }],
                    ['label' => '实际支付', 'value' => function($row){

                        return $row['smart_orders']['pay_money']/100;
                    }],
                    ['label' => '优惠金额', 'value' => function($row){
                        return $row['price'];
                    }],
                    ['label' => '订单状态', 'value' => function($row){
                        return \backend\models\SmartOrders::getStatus()[$row['smart_orders']['status']];
                    }],
                    ['label' => '会员卡号', 'value' =>function($row){
                        return \backend\models\SmartMemberCard::sGetCardNo($row['card_id']);
                    }]
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

