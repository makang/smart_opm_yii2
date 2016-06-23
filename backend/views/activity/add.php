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

<script src="/assets_ace/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="/assets_ace/css/chosen.css" />


<link rel="stylesheet" href="/assets_ace/css/bootstrap-timepicker.css" />
<script src="/assets_ace/js/date-time/bootstrap-timepicker.min.js"></script>


<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<link rel="stylesheet" href="/assets_ace/css/date-time/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>

<link rel="stylesheet" href="/assets_ace/css/datepicker.css" />
<script src="/assets_ace/js/date-time/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets_ace/js/date-time/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>


<div class="page-content">
    <div class="page-header">
        <h1>
            活动创建步骤
            <small>
                <i class="icon-double-angle-right"></i>
                这儿是流程说明，希望能出个建议的指示流程图
            </small>
        </h1>
    </div><!-- /.page-header -->

    <form class="form-horizontal" role="form" id="form">
    <div class="row">
        <div class="col-xs-12">

            <!-- PAGE CONTENT BEGINS -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable">
                        <ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
                            <li class="li-new-mail pull-right">
                                <a data-toggle="tab" href="#write" data-target="write" class="btn-new-mail" id="submit">
                                    <span class="btn bt1n-small btn-purple no-border">
                                        <i class=" icon-envelope bigger-130"></i>
                                        <span class="bigger-110 submit" >发布活动</span>
                                    </span>
                                </a>
                            </li><!-- ./li-new-mail -->


                            <li class="active" >
                                <a data-toggle="tab" href="#info">
                                    <i class="blue icon-inbox bigger-130"></i>
                                    <span class="bigger-110">创建营销活动</span>
                                </a>
                            </li>

                            <li >
                                <a data-toggle="tab" href="#time">
                                    <i class="orange icon-location-arrow bigger-130 "></i>
                                    <span class="bigger-110">设定场次信息</span>
                                </a>
                            </li>



                            <li >
                                <a data-toggle="tab" href="#price">
                                    <i class="green icon-pencil bigger-130"></i>
                                    <span class="bigger-110">设定价格方案</span>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab"href="#ticket">
                                    <i class="pink icon-tags bigger-130"></i>
                                    <span class="bigger-110">设定活动票数</span>
                                </a>
                            </li><!-- /.dropdown -->
                        </ul>

                        <div class="tab-content no-border no-padding">

                            <div class="tab-pane in active" id="info">
                                <?php  echo $this->render('_info'); ?>
                            </div><!-- /.tab-pane -->


                            <div class="tab-pane " id="time">
                                <?php  echo $this->render('_time'); ?>
                            </div>

                            <div class="tab-pane " id="price">
                                <?php  echo $this->render('_price'); ?>
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="ticket">
                                <?php  echo $this->render('_ticket'); ?>
                            </div><!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- /.tabbable -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
        </form>
</div>













