<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Article;
use backend\models\SmartCinema;
use yii\widgets\ActiveForm;
?>

<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="/assets_ace/js/jquery.slimscroll.min.js"></script>



<div class="row">
    <div class="col-xs-12">
        <div class="widget-box transparent invoice-box">
            <div class="widget-header widget-header-large">
                <h3 class="grey lighter pull-left position-relative">
                    <i class="icon-leaf green"></i>
                    公众号影院绑定
                </h3>


            </div>





            <div class="widget-body">
                <div class="widget-main padding-24">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
                                    <b>信息</b>
                                </div>
                            </div>

                            <div class="row">
                                <ul class="list-unstyled spaced">
                                    <li>
                                        <i class="icon-caret-right blue"></i>
                                       开放平台注册公司名称
                                    </li>

                                    <li>
                                        <i class="icon-caret-right blue"></i>
                                        微信公众号
                                    </li>

                                    <li>
                                        <i class="icon-caret-right blue"></i>
                                        绑定影院
                                    </li>

                                </ul>
                            </div>
                        </div><!-- /span -->

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                    <b>内容</b>
                                </div>
                            </div>

                            <div>
                                <ul class="list-unstyled  spaced">
                                    <li>
                                        <i class="icon-caret-right green"></i>
                                       <?=$publicSignal->PublicSignalNickname;?>
                                    </li>

                                    <li>
                                        <i class="icon-caret-right green"></i>
                                        <?=$publicSignal->PublicSignalName;?>
                                    </li>

                                    <li>
                                        <i class="icon-caret-right green"></i>
                                        <input type="hidden" name="pid" value="<?=$publicSignal->pid;?>">
                                        <a href="#modal-form" role="button" class="blue" data-toggle="modal"> 点我匹配 </a>
                                    </li>


                                </ul>
                            </div>
                        </div><!-- /span -->
                    </div><!-- row -->

                    <div class="space"></div>







                    <div>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="center">影院编号</th>
                                <th>影院名称</th>
                                <th class="hidden-xs">地址</th>
                                <th class="hidden-480">操作</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                                foreach($PublicSignalCinemas as $v){
                                    ?>

                                    <tr>
                                        <td class="center"><?=$v['CinemaNo']?></td>

                                        <td>
                                            <a href="#"><?=$v['CinemaName']?></a>
                                        </td>
                                        <td class="hidden-xs">
                                            <?=$v['Address']?>
                                        </td>
                                        <td class="hidden-480">
                                            <a class="confirm" href="/manage/unbind-cinema?cinemaNo=<?=$v['CinemaNo']?>&pid=<?=$publicSignal->pid?>">取消绑定</a>
                                            <a href="/manage/view?cinemeNo=<?=$v['CinemaNo']?>&pid=<?=$publicSignal->pid?>">账号信息</a>
                                        </td>
                                    </tr>


                                <?php
                                }
                            ?>




                            </tbody>
                        </table>
                    </div>


                </div>
            </div>




        </div>

    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>



<!--弹层 绑定影院-->
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
        var pid     = $('input[name=pid]').val();
        console.log(pid);
        if(keyword == ''){alert('请输入影院关键字');return false;};
        $.getJSON('/activity/ajax-get-cinema',{'key':keyword},function(data){
            $('#cinemaBody').html('');
            var cinema      = data['cinema'];
            for(prv in cinema){

                $('<tr><td>'+prv+'</td><td>'+cinema[prv]+'</td><td> <a class="confirm" href="/manage/bind-cinema?pid='+pid+'&cinemaNo='+prv+'">绑定</a></td></tr>').
                    appendTo('#cinemaBody')

            }

        })
    })
    $('.dialogs').slimScroll({height: '300px'});
    jQuery(function($) {
        //全选checkbox
        $(document).on('click', '.confirm', function () {
           return confirm('确定要绑定');
        });
    });
</script>
<!--弹层 绑定影院-->