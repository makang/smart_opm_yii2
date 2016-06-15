<div class="message-container">

    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">使用提示</span>
                <span class="grey bigger-110">完善完成活动的价格设置，智慧影院会按照您设定的活动价与您结算活动票</span>
            </div>

        </div>
    </div>


    <div class="message-list-container" style="padding-top:10px">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                上报票房价格
            </label>

            <div class="col-sm-9">
                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="report_price_type" checked value="0">
                    <span class="label pointer label-warning"> 不变</span>
                </label>

                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="report_price_type" value="1">
                    <span class="label pointer"> 调整为</span>
                    <input type="text" id="form-field-1" disabled placeholder="" class="input-small" />&nbsp;元
                    <i class="icon-question-sign red bigger-120" data-content="Hello Everybody<br />Test(br)!" data-placement="right"
                       data-rel="popover" ></i>
                </label>




            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 价格保护 </label>

            <div class="col-sm-9">
                <label class="col-xs-5">
                    <input class="ace" type="checkbox" disabled="" checked name="form-field-checkbox">
                    <span class="lbl"> 上报票房价格不得低于最低发行价</span>
                    <i class="icon-question-sign red bigger-120" data-content="该选项不可取消，且只适用于使用鼎鑫、火凤凰、火烈鸟三家系统的影院。" data-placement="right"
                       data-rel="popover" ></i>
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 售卖价 </label>

            <div class="col-sm-9">
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="people" checked>

                    <span class="label pointer label-warning"> 原价基础上减&nbsp;</span>
                    <input type="text" class="input-small">&nbsp;元
                </label>

                <label class="rl">
                    <input class="" type="radio" name="people">
                    <span class="label pointer"> 固定价格&nbsp;</span>
                    <input type="text" class="input-small" disabled>&nbsp;元
                </label>
                    <i class="icon-question-sign red bigger-120" data-content="原售卖价”指（上传售票系统的价格+服务费）。<br/>此处设置的固定价格包含服务费，示例：固定价格设置为9.9元，<br/>即用户实际购买价为9.9元，9.9元中包含每张票相应的服务费。" data-placement="right"
                       data-rel="popover" ></i>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 补贴方式 </label>

            <div class="col-sm-9">
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="people" checked>

                    <span class="label pointer label-warning"> 补贴票数&nbsp;</span>
                    <input type="text" class="input-small">&nbsp;张
                </label>

                <label class="rl">
                    <input class="" type="radio" name="people">
                    <span class="label pointer"> 预算金额&nbsp;</span>
                    <input type="text" class="input-small" disabled>&nbsp;元
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 选择影片 </label>

            <div class="col-sm-9">
                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="filmLmit" id="filmLimit" checked>
                    <span class="label pointer label-warning"> 全部</span>
                </label>

                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="filmLmit">
                    <span class="label pointer"> 选择影片</span>

                </label>

                <label>
                     <div class="input-icon">
                        <input id="filmKeyword" type="text">
                        <i class="icon-search blue"></i>
                         <button class="btn btn-purple btn-sm searchFilm" type="button">
                             搜索
                             <i class="icon-search icon-on-right bigger-110"></i>
                         </button>
                    </div>
                </label>
            </div>
        </div>

        <div class="space-4"></div>


        <div class="form-group">


            <div class="col-sm-6">
                <div class="widget-box ">
                    <div class="widget-header">
                        <h4 class="lighter smaller">
                            <i class="icon-comment blue"></i>
                            待选影片
                            <label class="selectCinemaAll" id="selectMovie">
                                <input class="ace ace-checkbox-2" type="checkbox" name="form-field-checkbox">
                                <span class="lbl"> 全选</span>
                            </label>
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs"  id="selectMovieFrom">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="widget-box ">
                    <div class="widget-header">
                        <h4 class="lighter smaller">
                            <i class="icon-comment blue"></i>
                            已选影片
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs" id="selectMovieTo">



                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>





    </div><!-- /.message-list-container -->
</div><!-- /.message-container -->

<script>
    jQuery(function($) {

        $('.dialogs').slimScroll({
            height: '300px'
        });
        //搜索影院信息
        $('.searchFilm').on('click',function(){
            var keyword = $('#filmKeyword').val();
            var all     = $('#filmLimit').prop('checked');
            if(keyword == ''){alert('请输入影片关键字');return false;};
            if(all){alert('全部不用筛选影片');return false};

            $.getJSON('/activity/ajax-get-film',{'key':keyword},function(data){
                $('#selectCinemaFrom').html('');
                var film      = data['film'];

                for(prv in film){
                    if(!selectFilm[prv]==1){
                        $('<div class="infobox infobox-green infobox-small infobox-dark switch">' +
                        '<input type="hidden" name="films[]" value="'+prv+'">'+film[prv]+' </div>')
                            .appendTo('#selectMovieFrom')
                    }
                }

            })
        })

    });

</script>