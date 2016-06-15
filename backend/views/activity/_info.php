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
                <input type="text" id="datepickers" name="start_date" class="search-query datepicker" placeholder="开始日期" value=""/>
                --
                <input type="text" id="datepickere" name="start_date" class="search-query datepicker" placeholder="结束日期" value=""/>

            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 活动结束 </label>

            <div>
                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="lack_stock_show" checked value="0">
                    <span class="label label-warning pointer"> 库存不足自动结束</span>
                </label>

                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="lack_stock_show" value="1">
                    <span class="label  pointer"> 库存不足继续展示</span>
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户人群 </label>

            <div>
                <label class="col-xs-1 rl">
                    <input class="" type="radio" name="userLimit" checked value="0">
                    <span class="label label-warning pointer"> 不限</span>
                </label>

                <label class="col-xs-1 rl">
                    <input class="" type="radio" name="userLimit" value="1">
                    <span class="label  pointer"> 新用户</span>
                </label>

                <label class="col-xs-1 rl">
                    <input class="" type="radio" name="userLimit" value="2">
                    <span class="label pointer"> 老用户</span>
                </label>
                <label class="col-xs-1 rl">
                    <input class="" type="radio" name="userLimit" value="3">
                    <span class="label pointer"> 会员</span>
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 参与影院 </label>

            <div >
                <label class="col-xs-1 rl">
                    <input class="" type="radio" name="cinemaLimit" checked value="0" id="cinemaLimit">
                    <span class="label label-warning pointer"> 全国</span>
                </label>

                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="cinemaLimit" value="1">
                    <span class="label pointer"> 手动选择</span>
                </label>

                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="cinemaLimit" value="2">
                    <span class="label pointer"> 排除影院</span>
                </label>

                <label class="col-xs-3">
                    <div class="input-icon">
                        <input id="cinemaKeyword" type="text" placeholder="输入影院关键字">
                        <i class="icon-search blue"></i>
                        <button class="btn btn-purple btn-sm searchCinema" type="button">
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
                            待选影院
                            <label class="selectCinemaAll" id="selectCinema">
                                <input class="ace ace-checkbox-2" type="checkbox" name="form-field-checkbox">
                                <span class="lbl"> 全选</span>
                            </label>
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs " id="selectCinemaFrom">


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
                            已选影院
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs" id="selectCinemaTo">

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>










    </div><!-- /.message-list-container -->
</div><!-- /.message-container -->

<script>
    var selectCinema = {};              //选择上的影院
    var totalCinema  = {};              //全部的影厅
    var selectHall   = {};              //选择上的影厅
    var totalHall    = {};              //全部的影厅
    var selectFilm   = {};              //选择上的影院
    var totalFilm    = {};              //全部的影厅
    jQuery(function($) {
        //日历选择
        $(".datepicker").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: "yy-mm-dd",
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六']
        })
        //滚动轴
        $('.dialogs').slimScroll({height: '300px'});
        //小手
        $('.pointer').css('cursor','pointer');
        //右侧提示框
        $('[data-rel=popover]').popover({html:true});
        //radio 选择器
        $('.rl').on('click',function(){
            $(this).siblings().children('span').attr('class','label pointer');
            $(this).siblings().children('input[type=text]').attr('disabled','disabled');
            $(this).children('span').attr('class','label pointer label-warning');
            $(this).children('input[type=text]').removeAttr('disabled');
        })


        //增加排除优惠时间
        $('#addDay').on('click',function(){
            var date = $(this).prev().val();
            if(date==''){
                alert('请选择日期');
            }else{
                $('<span class="label label-warning" style="margin-right:1px">'+date+' ' +
                '<i class="icon-remove red bigger-120"></i> </span>').appendTo('#addDayContenter');
            }
        })


        //增加优惠场次时段
        $('#addTime').on('click',function(){
            var start = $(this).parent().prev().prev().children('input[type=text]').val();
            var end = $(this).parent().prev().children('input[type=text]').val();
            if(start == '' || end == ''){
                alert('请选择时间段');
            }else{
                $('<span class="label label-warning" style="margin-right:1px;margin-top:1px">'+start+"-"+end+' ' +
                '<i class="icon-remove red bigger-120"></i> </span>').appendTo('#addTimeContenter');
            }

        })

        //全选影院
        $('.selectCinemaAll').on('click',function(){
            var checked = $(this).children('input[type=checkbox]').is(":checked");
            var name    = $(this).attr('id');
            var from    =   '';
            var to      =   '';
            if(checked){
                from = name+'From';
                to   = name+'To';
            }else{
                from = name+'To';
                to   = name+'From';
            }
            $('#'+from).children().appendTo('#'+to)
        })

        //搜索影院信息
        $('.searchCinema').on('click',function(){
            var keyword = $('#cinemaKeyword').val();
            var all     = $('#cinemaLimit').prop('checked');
            if(keyword == ''){alert('请输入影院关键字');return false;};
            if(all){alert('全国不用筛选影院');return false};
            $.getJSON('/activity/ajax-get-cinema',{'key':keyword},function(data){
                $('#selectCinemaFrom').html('');
                var cinema      = data['cinema'];
                totalHall       = data['hall'];
                totalCinema     = cinema;
                for(prv in cinema){
                    if(!selectCinema[prv]==1){
                        $('<div class="infobox infobox-green infobox-small infobox-dark switch">' +
                        '<input type="hidden" name="CinemaS[]" value="'+prv+'">'+cinema[prv]+' </div>')
                            .appendTo('#selectCinemaFrom')
                    }
                }

            })
        })

        //删除节点
        $(document).on('click', '.icon-remove', function() {$(this).parent().remove();});
        //筛选影片，影院
        $(document).on('click', '.switch', function() {
            var dest = '';
            var pid = $(this).parent().attr('id');
            var cinemaNo = $(this).children('input[type=hidden]').val();
            if(pid=='selectCinemaFrom'){
                selectCinema[cinemaNo]  = 1;
                selectHall[cinemaNo]    = totalHall[cinemaNo];
                generateHall(selectHall);                           //选中影院后，影厅自动对应展示
                dest = 'selectCinemaTo';
            }else if(pid=='selectCinemaTo'){
                delete selectCinema[cinemaNo];
                delete selectHall[cinemaNo];
                generateHall(selectHall);                           //选中影院后，影厅自动对应展示
                dest = 'selectCinemaFrom';
            }else if(pid=='selectMovieTo'){
                delete selectFilm[cinemaNo];
                dest = 'selectMovieFrom';
            }else if(pid='selectMovieFrom'){
                selectFilm[cinemaNo]  = 1;
                dest = 'selectMovieTo';
            }
            console.log(selectFilm);
            $('#'+dest).append($(this));
        });
        //全选checkbox
        $(document).on('click','.checkbox-all',function(){
            var checked = $(this).children('input[type=checkbox]').is(":checked");
            if(checked){
                $(this).siblings().children('input[type=checkbox]').prop("checked",true);
            }else{
                $(this).siblings().children('input[type=checkbox]').prop("checked",false)
            }
        });




    });

</script>