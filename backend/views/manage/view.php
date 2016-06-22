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



        <form class="form-horizontal" method="post" role="form" action="/<?=Yii::$app->controller->id;?>/csave">



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ParterId
                    <span class="red">*</span> </label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->partner_id;?>"  class="col-xs-10 col-sm-5" name="partner_id"/>
                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> PartnerKey
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->partner_key;?>" class="col-xs-10 col-sm-5" name="partner_key" />
                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> SubMichId
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->mich_id;?>" class="col-xs-10 col-sm-5" name="mich_id" />
                </div>
            </div>

            <div class="space-4"></div>






            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> key
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->mich_key;?>" class="col-xs-10 col-sm-5" name="mich_key"/>
                </div>
            </div>





            <div class="space-4"></div>

            <div class="form-group pk" >
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">公钥证书
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <textarea name="PublicKey"><?=$row->PublicKey;?></textarea>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group pk" >
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">私钥证书
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <textarea name="PrivateKey"><?=$row->PrivateKey;?></textarea>
                </div>
            </div>



            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <input type="hidden" name="cinemaNo" value="<?=$row->cinema_no?>">
                    <button class="btn btn-info" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        保存
                    </button>


                </div>
            </div>
        </form>




    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>


<script type="text/javascript">
    jQuery(function($) {
    });



</script>





