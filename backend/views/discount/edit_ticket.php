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
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="ticketlimit" value="0" checked>

                    <span class="label pointer label-warning"> 不限</span>
                </label>

                <label class="rl">
                    <input class="" type="radio" name="ticketlimit" value="1">
                    <span class="label pointer"> 限购&nbsp;</span>
                    <input type="text" class="input-small" disabled name="one_use_max">&nbsp;张
                </label>


            </div>
        </div>


        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 电影版本 </label>

            <div class="col-sm-9 ">
                <label class="inline checkbox-all">
                    <input class="ace " type="checkbox" name="version">
                    <span class="lbl pointer">全部</span>
                </label >

                <label>
                    <input class="ace" type="checkbox" name="version" value="2D">
                    <span class="lbl pointer"> 2d</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="3D">
                    <span class="lbl pointer"> 3d</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="IMAX2D">
                    <span class="lbl pointer"> IMAX2D</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="IMAX3D">
                    <span class="lbl pointer">  IMAX3D </span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="versionx" value="IMAX">
                    <span class="lbl pointer"> IMAX</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="DMAX">
                    <span class="lbl pointer"> DMAX</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="DMAX3D">
                    <span class="lbl pointer"> DMAX3D</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="中国巨幕">
                    <span class="lbl pointer"> 中国巨幕</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="version" value="4D">
                    <span class="lbl pointer"> 4D</span>
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