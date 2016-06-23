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
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 场次价格保护 </label>

            <div class="col-sm-9">
                <input type="text" id="" value="<?php echo $discountInfo['protect_price'];?>" name="scenes_price_protection" maxlength="14" placeholder="" class="col-xs-10 col-sm-5" />
                <span class="red"> 场次原价格高于此价格，则不参加本次活动(包含手续费) </span>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                <span class="red">*</span> 上报票房价格
            </label>

            <div class="col-sm-9">
                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="report_price_type"  <?php if($discountInfo['report_price_type']==0) echo 'checked';?> value="0">
                    <span class="label pointer <?php if($discountInfo['report_price_type']==0) echo 'label-warning';?>"> 不变</span>
                </label>

                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="report_price_type" value="1"  <?php if($discountInfo['report_price_type']==1) echo 'checked';?> >
                    <span class="label pointer <?php if($discountInfo['report_price_type']==1) echo 'label-warning';?>"> 调整为</span>
                    <input type="text" name="set_report_price" disabled placeholder="" class="input-small" <?php echo $discountInfo['set_report_price'];?>/>&nbsp;元
                    <i class="icon-question-sign red bigger-120" data-content="" data-placement="right"
                       data-rel="popover" ></i>
                </label>




            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>价格保护 </label>

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
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>售卖价 </label>

            <div class="col-sm-9">
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="discount_price_type" value="0" selected>

                    <span class="label pointer label-warning"> 原价基础上减&nbsp;</span>
                    <input type="text" name="discountprice" class="input-small"value="<?php echo $discountInfo['discount_price']/100;?>">&nbsp;元
                </label>

                <label class="rl">
                    <input class="" type="radio" name="discount_price_type" value="1" <?php if($discountInfo['discount_price_type']==1)echo 'checked';?>>
                    <span class="label pointer"> 固定价格&nbsp;</span>
                    <input type="text" class="input-small" name="discount_price" disabled>&nbsp;元
                </label>
                    <i class="icon-question-sign red bigger-120" data-content="原售卖价”指（上传售票系统的价格+服务费）。<br/>此处设置的固定价格包含服务费，示例：固定价格设置为9.9元，<br/>即用户实际购买价为9.9元，9.9元中包含每张票相应的服务费。" data-placement="right"
                       data-rel="popover" ></i>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="red">*</span> 补贴方式 </label>

            <div class="col-sm-9">
                <label class="col-xs-4 rl">
                    <input class="" type="radio" name="allowance_type" value="0" checked>

                    <span class="label pointer "> 补贴票数&nbsp;</span>
                    <input type="text" class="input-small" name="allowance_tickets" value="<?php echo $discountInfo['allowance_tickets'];?>">&nbsp;张
                </label>

                <label class="rl">
                    <input class="" type="radio" name="allowance_type" value="1"<?php if($discountInfo['allowance_type']==1) echo 'checked';?>>
                    <span class="label pointer label-warning"> 预算金额&nbsp;</span>
                    <input type="text" class="input-small" disable name="allowance_money" value="<?php echo $discountInfo['allowance_money'];?>">&nbsp;元
                </label>
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 选择影片 </label>

            <div class="col-sm-9">
                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="filmLmit" value="0" id="filmLimit" <?php if(!$discountInfo['join_movies']) echo 'checked';?>>
                    <span class="label pointer <?php if(!$discountInfo['join_movies']) echo 'label-warning';?>"> 全部</span>
                </label>

                <label class="col-xs-2 rl">
                    <input class="" type="radio" name="filmLmit" value="1" <?php if($discountInfo['join_movies']) echo 'checked';?>>
                    <span class="label pointer <?php if($discountInfo['join_movies']) echo 'label-warning';?>"> 选择影片</span>

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
                                <?php
                                 if($discountInfo['join_movies']) {
                                     $movieNos = json_decode($discountInfo['join_movies'], true);
                                     foreach ($movieNos as $movie_no) {
                                         $movie_name = \backend\models\SmartFilm::model()->sGetFilmNameByNo($movie_no);
                                         echo '<div class="infobox infobox-green infobox-small infobox-dark switch">
                                    <input type="hidden" value="' . $movie_no . '" name="films[]">' . $movie_name . '</div>';
                                     }
                                 }
                                ?>
                                <div class="infobox infobox-green infobox-small infobox-dark switch">
                                    <input type="hidden" value="1636" name="films[]">
                                    洛克王国3：圣龙的守护
                                </div>


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
                $('#selectMovieFrom').html('');
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

        var field = {
            'name':                     {'type':'text', 'error':"请填写活动名称",          require:1},
            'title':                    {'type':'text', 'error':"请填写活动文案",          require:1},
            'desc':                     {'type':'area', 'error':"请填写活动说明",          require:1},
            'startDatetime':            {'type':'text', 'error':"请填写活动开始时间",        require:1},
            'endDatetime':              {'type':'text', 'error':"请填写活动结束时间",        require:1},
            'lack_stock_show':          {'type':'radio', 'error':"请选择活动结束状态",       require:1},
            'userLimit':                {'type':'radio', 'error':"请选择用户人群",             require:1},
            'cinemaLimit':              {'type':'radio', 'error':"请选择参与影院",             require:1},
            'ticketStartTime':          {'type':'text',  'error':"请选择场次优惠开始日期",     require:1},
            'ticketEndTime':            {'type':'text',  'error':"请选择场次优惠结束日期",     require:1},
            'useTimes':                 {'type':'hidden',  'error':"请设置优惠时段",           require:1},
            'myNoUseDates':             {'type':'hidden',  'error':"",                      require:0},
            'Selecthalls':              {'type':'radio',  'error':"请选择影厅",          require:1},
            'scenes_price_protection':  {'type':'text',  'error':"",                        require:0},
            'report_price_type':        {'type':'radio',  'error':"请设置上报票房价格",        require:1,
                                        sub:{1:'set_report_price'}},
            'discount_price_type':      {'type':'radio',  'error':"请设置售卖价",              require:1,
                                        sub:{0:'discountprice',      1:'discount_price'}},
            'allowance_type':           {'type':'radio',  'error':"请设置补贴方式",              require:1,
                                        sub:{0:'allowance_tickets',  1:'allowance_money'}},
            'filmLmit':                 {'type':'radio',  'error':"请设置影片",              require:1},
            'ticketlimit':              {'type':'radio',  'error':"请设置用户限购",              require:1,
                                        sub:{1:'one_use_max'}},
            'version':                  {'type':'check',  'error':"电影版本",              require:0}
        }

        //提交信息
        $('#submit').on('click',function(){
            var postData = {};
            for(prv in field){
                if(field[prv]['type'] == 'text'){
                    postData[prv] = $('#form input[name='+prv+']').val();
                }else if(field[prv]['type'] == 'area')
                {
                    postData[prv] = $('#form textarea[name='+prv+']').val();
                }else if(field[prv]['type'] == 'radio'){

                    postData[prv] = $('#form input[name="'+prv+'"]:checked').val();
                    if(field[prv].sub && field[prv]['sub'][postData[prv]]){
                        postData[field[prv]['sub'][postData[prv]]] =  $('#form input[name='+field[prv]['sub'][postData[prv]]+']').val(); ;
                    }
                }else if(field[prv]['type'] == 'check'){
                    var v = '';
                    $("#form input[name='"+prv+"']:checked").each(function(){
                        if($(this).prop("checked")){
                            v += $(this).val()+","
                        }
                    })
                    postData[prv] = v;
                }else if(field[prv]['type'] == 'hidden'){
                    var v = '';
                    $('#form input[name="'+prv+'[]"]').each(function(){v += $(this).val()+","});
                    postData[prv] = v;
                }
                if(field[prv]['require'] ==1 && postData[prv] == '') {alert(field[prv]['error']);return false;}
            };

            //选择影院
            if(postData['cinemaLimit']!=0){
                var v = '';
                $('#form #selectCinemaTo input[name="CinemaS[]"]').each(function(){v += $(this).val()+","});
                postData['CinemaS'] = v;
            }
            //选择影片
            if(postData['filmLmit']!=0){
                var v = '';
                $('#form #selectMovieTo input[name="films[]"]').each(function(){v += $(this).val()+","});
                postData['films'] = v;
            }

            //选择影厅
            if(postData['Selecthalls']!=0){
                var v = '';
                $('#form #cinemaHall input[name="halls[]"]:checked').each(function(){v += $(this).val()+","});
                postData['Selecthalls'] = v;

            }
            $.post("/activity/save", postData, function(data){
                var ret = eval('(' + data + ')');
                if(ret.code!='200'){alert(ret.msg)}else{
                    location = '/discount/list';
                }
            });

        });

    });

</script>