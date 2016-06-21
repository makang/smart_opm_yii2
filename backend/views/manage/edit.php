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
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 微信公众号id
                    <span class="red">*</span> </label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->Id;?>"  class="col-xs-10 col-sm-5" name="Id"/>
                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 微信公众号昵称
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->PublicSignalNickname;?>" class="col-xs-10 col-sm-5" name="PublicSignalNickname" />
                </div>
            </div>

            <div class="space-4"></div>



            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 原始id
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->PublicSignalInitId;?>" class="col-xs-10 col-sm-5" name="PublicSignalInitId" />
                </div>
            </div>

            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公众号内容主题 </label>

                <div>

                    <?php

                        foreach($theme as $k=>$v){
                            if($k==$row->PublicSignalTheme){
                                ?>
                                <label style="padding-left:10px">
                                    <input class="" type="radio" name="PublicSignalTheme" checked value="<?= $k;?>">
                                    <span class="label label-warning pointer"> <?= $v;?></span>
                                </label>
                            <?php

                            }else{
                                ?>

                                <label style="padding-left:10px">
                                    <input class="" type="radio" name="PublicSignalTheme" value="<?= $k;?>">
                                    <span class="label label-warning pointer"> <?= $v;?></span>
                                </label>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公众号类型 </label>

                <div>

                    <?php

                    foreach($type as $k=>$v){
                        if($k==$row->PublicSignalType){
                            ?>
                            <label style="padding-left:10px">
                                <input class="" type="radio" name="PublicSignalType" checked value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php

                        }else{
                            ?>

                            <label style="padding-left:10px">
                                <input class="" type="radio" name="PublicSignalType" value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>


            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公众号订座接口 </label>

                <div>
                    <label style="padding-left:10px">
                        <input class="" type="radio" name="InterfaceType" value="1">
                        <span class="label label-warning pointer"> 微影</span>
                    </label>
                    <label style="padding-left:10px">
                        <input class="" type="radio" name="InterfaceType" checked value="2">
                        <span class="label label-warning pointer"> 开放平台</span>
                    </label>
                </div>
            </div>


            <h3 class="header smaller lighter red"></h3>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公众号标题
                    <span class="red">*</span> </label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->PublicSignalTitle;?>" class="col-xs-10 col-sm-5" name="PublicSignalTitle"/>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公众号客服电话
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->PublicSignalCustomerServicePhone;?>" class="col-xs-10 col-sm-5" name="PublicSignalCustomerServicePhone" />
                </div>
            </div>

            <div class="space-4"></div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 微信公众号缩写
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->PublicSignalShort;?>" class="col-xs-10 col-sm-5" name="PublicSignalShort"/>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> TOKEN
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?=$row->Token;?>" class="col-xs-10 col-sm-5" name="Token"/>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 回调url
                    <span class="red">*</span></label>

                <div class="col-sm-9">
                    <input type="text" value="<?php echo "http://op.wxmovie.com/weixin/callback";?>" class="col-xs-10 col-sm-5" name="ReturnUrl"/>
                </div>
            </div>

            <div class="space-4"></div>









            <h3 class="header smaller lighter red"></h3>



            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 购买成功消息模板ID</label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->SuccessWeCathTemplateID;?>" class="col-xs-10 col-sm-5" name="SuccessWeCathTemplateID"/>
                </div>
            </div>



            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">购买失败消息模板ID </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->FailedWeCathTemplateID;?>" class="col-xs-10 col-sm-5" name="FailedWeCathTemplateID"/>
                </div>
            </div>



            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">充值成功消息模板ID </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->RechargeSuccessTemplateID;?>" class="col-xs-10 col-sm-5" name="RechargeSuccessTemplateID" />
                </div>
            </div>


            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">充值失败消息模板ID </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->RechargeFailTemplateID;?>" class="col-xs-10 col-sm-5" name="RechargeFailTemplateID"/>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">开场提醒消息模板ID </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->RemindTemplateID;?>" class="col-xs-10 col-sm-5" name="RemindTemplateID" />
                </div>
            </div>


            <h3 class="header smaller lighter red"></h3>


            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">APPID
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->AppId;?>" class="col-xs-10 col-sm-5" name="AppId" />
                </div>
            </div>


            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">APPSecret
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->AppSecret;?>" class="col-xs-10 col-sm-5" name="AppSecret" />
                </div>
            </div>


            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">PartnerId
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->PartnerId;?>" class="col-xs-10 col-sm-5" name="PartnerId" />
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">PartnerKey
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <input type="text" value="<?= $row->PartnerKey;?>" class="col-xs-10 col-sm-5" name="PartnerKey"/>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">是否需要分账号收款
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <?php

                    foreach($child as $k=>$v){
                        if($k==$row->IsChildAccount){
                            ?>
                            <label style="padding-left:10px">
                                <input class="" type="radio" name="IsChildAccount" checked value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php

                        }else{
                            ?>

                            <label style="padding-left:10px">
                                <input class="" type="radio" name="IsChildAccount" value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php
                        }
                    }
                    ?>
                </div>


            </div>


            <div class="space-4"></div>

            <div class="form-group pk" style="display: none">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">公钥证书
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <textarea name="PublicKey"><?=$row->PublicKey;?></textarea>
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group pk" style="display: none">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">私钥证书
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <textarea name="PrivateKey"><?=$row->PrivateKey;?></textarea>
                </div>
            </div>


            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">是否是受理商
                    <span class="red">*</span>
                </label>

                <div class="col-sm-9">
                    <?php

                    foreach($accept as $k=>$v){
                        if($k==$row->IsAcceptance){
                            ?>
                            <label style="padding-left:10px">
                                <input class="" type="radio" name="IsAcceptance" checked value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php

                        }else{
                            ?>

                            <label style="padding-left:10px">
                                <input class="" type="radio" name="IsAcceptance" value="<?= $k;?>">
                                <span class="label label-warning pointer"> <?= $v;?></span>
                            </label>
                        <?php
                        }
                    }
                    ?>

                </div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <input type="hidden" name="pid" value="<?=$row->pid?>">
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
        $('input[name=IsChildAccount]').on('click',function(){
            if( $('input[name="IsChildAccount"]:checked').val() == 0){
                $('.pk').css('display','block');
            }else{
                $('.pk').css('display','none');
            }
        })

    });



</script>





