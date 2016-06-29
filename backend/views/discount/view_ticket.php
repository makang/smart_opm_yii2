<div class="message-container">

    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">使用提示</span>
                <span class="grey bigger-110">完善活动的活动票数量,会员限制和电影版本等信息</span>
            </div>

        </div>
    </div>


    <div class="message-list-container" style="padding-top:10px">



        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>每人限购 </label>

            <div class="col-sm-9">

                <label class="col-xs-2 rl">
                    <?php if($discountInfo['one_use_max']){
                        echo '限购：'.$discountInfo['one_use_max'].'张';
                    }else{
                        echo '不限';
                    }?>
                </label>



            </div>
        </div>


        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 电影版本 </label>
             <?php
             $movieType=array();
              if($discountInfo['movie_type']){
                  $movieType=json_decode($discountInfo['movie_type'],true);
                  //var_dump($movieType);
              }
             ?>
            <div class="col-sm-9 ">
                <label class="inline checkbox-all">
                    <?php if(!$discountInfo['movie_type']) echo '全部';?>
                </label >

                <label>
                    <?php if(in_array("2D",$movieType)) echo '2d';?>

                </label>

                <label>
                    <?php if(in_array("3D",$movieType)) echo '3D';?>
                </label>

                <label>
                    <?php if(in_array("IMAX2D",$movieType)) echo 'IMAX2D';?>

                <label>
                    <?php if(in_array("IMAX3D",$movieType)) echo 'IMAX3D';?>
                </label>

                <label>
                    <?php if(in_array("IMAX",$movieType)) echo 'IMAX';?>
                </label>

                <label>
                    <?php if(in_array("DMAX",$movieType)) echo 'DMAX';?>
                </label>

                <label>
                    <?php if(in_array("DMAX3D",$movieType)) echo 'DMAX3D';?>
                </label>

                <label>
                    <?php if(in_array("中国巨幕",$movieType)) echo '中国巨幕';?>
                </label>

                <label>
                    <?php if(in_array("4D",$movieType)) echo '4D';?>

                </label>

            </div>
        </div>





    </div><!-- /.message-list-container -->
</div><!-- /.message-container -->

<script>
    jQuery(function($) {


        $('.dialogs').slimScroll({
            height: '300px'
        });

    });

</script>