<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
                            'action' => ['list'],
                            'method' => 'get',
                        ]); ?>

                        <span class="input-icon align-middle" >
                            <select name="status" style="width: 100px">
                                <?php
                                    foreach($dataStatus as $k=>$v){
                                        echo '<option value="'.$k.'">'.$v.'</option>';
                                    }
                                ?>

                            </select>

                        </span>
                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="name" class="search-query" placeholder="活动名称" value="<?= !empty($_REQUEST['name'])?$_REQUEST['name']:'' ?>"/>
                        </span>

                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="pc_id" class="search-query" placeholder="活动编号" value="<?= !empty($_REQUEST['pc_id'])?$_REQUEST['pc_id']:'' ?>"/>
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

                    ['label'=>'活动id','value'=>'pc_id'],
                    ['label'=>'活动名称','value'=>'name'],

                    [
                        'label'=>'开始时间',
                        'value'=>function($row){
                            $row = json_decode($row['days'],true);
                            return $row[0]['start'];
                        }
                    ],

                    [
                        'label'=>'结束时间',
                        'value'=>function($row){
                            $row = json_decode($row['days'],true);
                            return $row[0]['end'];
                        }
                    ],

                    ['label'=>'已售立减票','value'=>'ticket_num'],

                    ['label'=>'已减金额','value'=>'send_money'],

                    ['label'=>'立减总额','value'=>'sum_amount'],
                    [
                        'label'=>'活动状态',
                        'format'=>'html',
                        'value'=>function($row){
                            return \backend\models\SmartPriceCut::model()->sGetStatus($row['status']);
                        }],


//                    [
//                        'class' => 'yii\grid\ActionColumn',
//                        'header' => '操作',
//                        'template' => '{detail} ',
//                        'headerOptions' => ['width' => '170'],
//                        'buttons' => [
//                            'detail' => function($url, $row, $key){
//                                return \backend\models\SmartPriceCut::model()->sGetAction($row);
//
//                            }
//                        ],
//                    ]

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

        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if( ("title_html" in this.options) && this.options.title_html == true )
                    title.html($title);
                else title.text($title);
            }
        }));
        $("a[data-confirm]").on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $( "#dialog-confirm" ).removeClass('hide').dialog({
                resizable: false,
                modal: true,
                title: '<div class="widget-header"><h4 class="smaller"><i class="icon-warning-sign red"></i> '+$(this).attr('data-confirm')+'</h4></div>',
                title_html: true,
                buttons: [
                    {
                        html: "<i class='icon-trash bigger-110'></i>忍痛删除",
                        "class" : "btn btn-danger btn-xs",
                        click: function() {

                            $( this ).dialog( "close" );
                            window.location.href = url;
                        }
                    }
                    ,
                    {
                        html: "<i class='icon-remove bigger-110'></i>取消",
                        "class" : "btn btn-xs",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });
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



