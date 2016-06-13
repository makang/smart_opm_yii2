<div class="message-container">

    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">使用提示</span>
                <span class="grey bigger-110">完善完成活动的基本信息，影院，以及用户信息方可正常使用哦</span>
            </div>

        </div>
    </div>


    <div class="message-list-container" style="padding-top:10px">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                活动名称
            </label>

            <div class="col-sm-9">
                <input type="text" id="form-field-1" placeholder="请输入优惠名称且长度不能超过8个汉字" class="col-xs-10 col-sm-5" />
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 活动文案 </label>

            <div class="col-sm-9">
                <input type="text" id="form-field-1" placeholder="请输入活动文案且长度不能超过14个汉字" class="col-xs-10 col-sm-5" />
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 活动说明 </label>

            <div class="col-sm-9">
                <textarea id="form-field-8" class="col-xs-10 col-sm-5" placeholder="请输入活动说明且长度不能超过140个汉字"></textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 起止时间 </label>

            <div class="col-sm-9">
                <input type="text" id="datepickers" name="start_date" class="search-query" placeholder="开始日期" value=""/>
                --
                <input type="text" id="datepickere" name="start_date" class="search-query" placeholder="结束日期" value=""/>

            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 活动结束 </label>

            <div>
                <label class="col-xs-2">
                    <input class="" type="radio" name="end" checked>
                    <span class="label label-warning arrowed pointer"> 库存不足自动结束</span>
                </label>

                <label class="col-xs-2">
                    <input class="" type="radio" name="end">
                    <span class="label label-warning arrowed pointer"> 库存不足继续展示</span>
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户人群 </label>

            <div>
                <label class="col-xs-1">
                    <input class="" type="radio" name="people" checked>
                    <span class="lbl pointer"> 不限</span>
                </label>

                <label class="col-xs-1">
                    <input class="" type="radio" name="people">
                    <span class="lbl pointer"> 新用户</span>
                </label>

                <label class="col-xs-1">
                    <input class="" type="radio" name="people">
                    <span class="lbl pointer"> 老用户</span>
                </label>
                <label class="col-xs-1">
                    <input class="" type="radio" name="people">
                    <span class="lbl pointer"> 会员</span>
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 参与影院 </label>

            <div >
                <label class="col-xs-1">
                    <input class="ace" type="radio" name="cinema" checked>
                    <span class="lbl pointer"> 全国</span>
                </label>

                <label class="col-xs-1">
                    <input class="ace" type="radio" name="cinema">
                    <span class="lbl pointer"> 手动选择</span>
                </label>

                <label class="col-xs-1">
                    <input class="ace" type="radio" name="cinema">
                    <span class="lbl pointer"> 排除影院</span>
                </label>

                <label class="col-xs-6">
                    <select multiple="" class="width-80 chosen-select tag-input-style"  data-placeholder="选择影院...">
                        <option value="">&nbsp;</option>
                        <option value="AL">大地a影院</option>
                        <option value="AK">大地b影院</option>
                        <option value="AZ">大地c影院</option>
                        <option value="AR">大地d影院</option>
                        <option value="CA">金逸e影院</option>
                        <option value="CO">金逸f影院</option>
                        <option value="CT">金逸g影院</option>
                        <option value="DE">金逸h影院</option>
                        <option value="FL">金逸i影院</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="space-4"></div>


    </div><!-- /.message-list-container -->
</div><!-- /.message-container -->

<script>
    jQuery(function($) {
        $("#datepickers").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        })
        $("#datepickere").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        });

        $(".chosen-select").chosen({
            no_results_text : "未找到此选项!"
        });
        $('.pointer').css('cursor','pointer');
    });

</script>