<div class="message-container">

    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">使用手册</span>
                <span class="grey bigger-110">场次的使用指导</span>
            </div>

        </div>
    </div>

    <div class="message-list-container" style="padding-top:10px">

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>场次优惠日期
            </label>

            <div class="col-sm-9">
                <?php echo $discountInfo['discount_start_date']; ?>
                --
                <?php echo $discountInfo['discount_end_date']; ?>

            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>场次优惠时段
            </label>


            <div class="col-sm-9 " id="addTimeContenter">
                <?php
                if ($discountInfo['time_periods']) {
                    $time_periods = json_decode($discountInfo['time_periods'], true);
                    foreach ($time_periods as $time) {
                        echo '<span class="label label-warning" style="margin-right:1px;margin-top:1px">' . $time . '
<input type="hidden" value="' . $time . '" name="useTimes[]">
</span>';
                    }
                }
                ?>

            </div>


        </div>

        <div class="space-4"></div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 排除优惠时间 </label>


            <div class="col-sm-9 " id="addDayContenter">
                <?php
                if ($discountInfo['exclude_dates']) {
                    $exclude_date = json_decode($discountInfo['exclude_dates'], true);
                    foreach ($exclude_date as $date) {
                        echo '<span class="label label-warning" style="margin-right:1px;">' . $date . '
                          <input type="hidden" value="' . $date . '" name="myNoUseDates[]"></span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="space-4"></div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <span class="red">*</span>影厅
            </label>

            <div class="col-sm-9">


                <label class="col-xs-2 rl">
                    <?php if($discountInfo['halls']){
                        echo '选择影厅';
                    }else if(!$discountInfo['halls']){
                        echo '全部';
                    } ?>
                </label>
            </div>
        </div>

        <div class="space-4">

        </div>


        <div class="form-group">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> </label>
            <div class="col-sm-8">
                <div class="widget-box ">
                    <div class="widget-header">
                        <h4 class="lighter smaller">
                            <i class="icon-comment blue"></i>
                            待选影厅
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs">

                                <ul class="item-list ui-sortable" id="cinemaHall">
                                    <?php
                                    if ($discountInfo['halls']) {
                                        $hall_no_list=array();
                                        $hall=json_decode($discountInfo['halls'],true);

                                        foreach ($hall as $k=>$v){
                                               $hall_no_list[]=$k;
                                        }

                                    if ($discountInfo['join_cinemas']) {
                                        $cinemaNos = json_decode($discountInfo['join_cinemas'], true);
                                        foreach ($cinemaNos as $cinema_no) {
                                            $cinema_name = \backend\models\SmartCinema::getCinemaNameByCinemaNo($cinema_no);
                                            $hallInfo = \backend\models\SmartHall::model()->aGetHallByCinemaNos($cinema_no);
                                            $hall_string = '<li class="item-blue clearfix">';

                                            $hall_string .= '<label class="inline checkbox-all pointer"><span class="lbl text-primary"> 全选（' . $cinema_name . '）</span></label>';

                                            foreach ($hallInfo[$cinema_no] as $hall) {
                                                //var_dump($hall);exit;
                                                    $checked=in_array($hall['hall_no'],$hall_no_list)?'checked':'';
                                                    $hall_string .= '<label class="inline pointer" style="padding-right:10px"><span class="lbl"> ' . $hall['hall_name'] . '</span></label>';

                                            }
                                            $hall_string .= '</label>';
                                            echo $hall_string;
                                        }
                                    }
                                    }
                                    ?>

                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>


    $('.timepicker').timepicker({
        minuteStep: 1,
        showMeridian: false
    }).next().on(ace.click_event, function () {
        $(this).prev().focus();
    });


    function generateHall(halls) {
        $('#cinemaHall').html('');
        for (prv in halls) {

            chooseHall(halls[prv], totalCinema[prv], prv);
        }
    }

    function chooseHall(hall, cinema, cinemaNo) {
        //var hall = data['hall'];
        var hallstr = '';

        hallstr += '<li class="item-blue clearfix" >';
        hallstr += '<label class="inline checkbox-all pointer">';
        hallstr += '<input type="checkbox" class="ace " value="0">';
        hallstr += '<span class="lbl text-primary"> 全选（' + cinema + '）</span>';
        hallstr += '</label>';
        for (pt in hall) {
            hallstr += '<label class="inline pointer">';
            hallstr += '<input type="checkbox" name="halls[]" class="ace " value="' + hall[pt]['hall_no'] + '">';
            hallstr += '<span class="lbl"> ' + hall[pt]['hall_name'] + '</span>';
            hallstr += '</label>';
        }
        hallstr += '</li>';

        $(hallstr).appendTo('#cinemaHall');
    }

</script>