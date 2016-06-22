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
        <div class="table-responsive">

            <div class="row">
                <div class="col-sm-10">
                    <div id="sample-table-2_length" class="dataTables_length">

                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>


                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="pdId" class="search-query" placeholder="优惠活动id" value="<?= !empty($_REQUEST['pdId'])?$_REQUEST['pdId']:'' ?>"/>
                        </span>

                        <span class="input-icon align-middle" >
                           <select name="type" style="width: 150px">
                                <option value="0">排期ID</option>
                               <option value="1">订单ID</option>

                           </select>
                        </span>



                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="value" class="search-query" placeholder="" value="<?= !empty($_REQUEST['value'])?$_REQUEST['value']:'' ?>"/>
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

            <?php
            if($msg){
                echo $msg;
            }else{
                echo $output;
            }

            ?>


        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>


<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click','.confirm',function(){
            var res = confirm('确定吗？亲');
            return res;
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



