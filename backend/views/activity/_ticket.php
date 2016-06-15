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
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 售卖价 </label>

            <div class="col-sm-9">
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="people" checked>

                    <span class="label pointer label-warning"> 不变</span>
                </label>

                <label class="rl">
                    <input class="" type="radio" name="people">
                    <span class="label pointer"> 新用户&nbsp;</span>
                    <input type="text" class="input-small" disabled>&nbsp;张
                </label>


            </div>
        </div>


        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 电影版本 </label>

            <div class="col-sm-9 ">
                <label class="inline checkbox-all">
                    <input class="ace " type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer">全部</span>
                </label >

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> 2d</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> 3d</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> IMAX2D</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer">  IMAX3D </span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> IMAX</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> DMAX</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> DMAX3D</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
                    <span class="lbl pointer"> 中国巨幕</span>
                </label>

                <label>
                    <input class="ace" type="checkbox" name="form-field-checkbox">
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