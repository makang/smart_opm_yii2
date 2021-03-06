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



        <form class="form-horizontal" method="post" role="form" action="/<?=Yii::$app->controller->id;?>/save">



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 影院选择
                    <span class="red">*</span> </label>

                <div class="col-sm-9">
                   <?php
                   $cinema = SmartCinema::model()->aGet($row['cinema_no']);
                   echo $cinema['CinemaName'];
                   ?>

                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 卖品条形码格式
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">



                        <?=$suitCodeEnc[$row['suit_code_enc']];?>


                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 电影票条形码格式
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">

                    <?=$suitCodeEnc[$row['ticket_code_enc']];?>
                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 票务系统费用
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                   <?=($row['booking_system_fee']/100)?>&nbsp;元
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 智慧影院费用
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <?=($row['open_system_fee']/100)?>&nbsp;元
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 影院费用
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <?=($row['cinema_fee']/100)?>&nbsp;元
                </div>
            </div>

            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 售票系统 </label>

                <div class="col-sm-9">
                        <?=$bookingSystem[$row['ticket_system']];?>
                </div>
            </div>

            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 是否开启卖品 </label>

                <div class="col-sm-9">
                    <?=$suitStatus[$row['has_suit']];?>

                </div>
            </div>


            <div class="space-4"></div>

        </form>




    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>
>
<script src="/assets_ace/js/jquery.slimscroll.min.js"></script>




<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="input-icon" style="width:450px">
                    <input type="text" id="cinemas" placeholder="我要搜索影院关键字">
                    <i class="icon-search blue"></i>
                    <button type="button" class="btn btn-purple btn-sm searchCinema">
                        搜索
                        <i class="icon-search icon-on-right bigger-110"></i>
                    </button>
                </div>

            </div>





            <div class="dialogs" style="overflow: hidden; width: auto; height: 300px;">

                <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                    <thead>
                    <tr>
                        <th>影院编号</th>
                        <th>影院名称</th>

                        <th>
                            <i class="icon-time bigger-110"></i>
                            操作
                        </th>
                    </tr>
                    </thead>

                    <tbody id="cinemaBody">



                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <span  class="pull-left"><input type="checkbox" id="checkall" /> 全选</span>
                <span  class="pull-left">&nbsp;共选择<span class="red" id="selected">0</span>家影院 </span>
                <button class="btn btn-sm btn-primary save" data-dismiss="modal">
                    <i class="icon-ok"></i>
                    保存
                </button>
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="icon-remove"></i>
                    关闭
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('.searchCinema').on('click',function(data){
        var keyword = $('#cinemas').val();

        if(keyword == ''){alert('请输入影院关键字');return false;};
        $.getJSON('/activity/ajax-get-cinema',{'key':keyword},function(data){
            $('#cinemaBody').html('');
            var cinema      = data['cinema'];
            for(prv in cinema){

                $('<tr class="choose"><td>'+prv+'</td><td>'+cinema[prv]+'</td><td>' +
                ' <a  href="" data-value="'+prv+'">选择</a></td></tr>').
                    appendTo('#cinemaBody')

            }

        })
    })
    $('#cinemaBody').css('cursor','pointer');
    $('.dialogs').slimScroll({height: '300px'});

    //全选影院
    $('#checkall').on('click',function(){
       if($(this).is(":checked")){
           $('#selected').html($('#cinemaBody').children('tr').length);
           $('#cinemaBody').children('tr').attr('class','choose red');
       }else{
           $('#selected').html(0);
           $('#cinemaBody').children('tr').attr('class','choose black');
       }
    })
    jQuery(function($) {
        //选择影院
        $(document).on('click', '.choose', function () {
            if($(this).attr('class') == 'choose red'){
                var selected = $('#selected').html();
                $(this).attr('class','choose black')

                $('#selected').html(--selected);
            }else{
                var selected = $('#selected').html();
                $(this).attr('class','choose red');
                $('#selected').html(++selected);
            }
            return false;
        });
    });

    $('.save').on('click',function(){
        $('#selectedCinema').html('');
        $('#cinemaBody .red a').each(function(){
            $('<input type="hidden" name="cinema_no[]" value="'+ $(this).attr('data-value')+'" />').appendTo('#selectedCinema');

        });

    })

</script>







