<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>

<script src='/assets_ace/js/jquery-2.0.3.min.js'></script>
<div class="control-group">
        <label class="control-label"> 影院名称：<font color="#FF0000"><?php echo isset($cinema_name)?$cinema_name:'';?></font></label>
			<span class="fl">
                <?php echo  Html::a('拉取排期',
                    ['schedulepull', 'cinema_no' => $cinema_no],
                    [
                        'class' => 'control-label',
                    ]
                );?>
			</span>
</div>
<!-- 左侧导航 start -->
<div class="x_aside" >
    <div class="x_asideDIV">
        <dl id="left" class="x-menu-l" style="float: left">
            <dt>
                <span style="width: auto">上映电影</span>
            </dt>
            <?php
            if(is_array($movie_list)&&$movie_list){
                foreach ($movie_list as $movie){ ?>
                    <dd class="cur" id="<?php echo $movie;?>" title="<?php echo $movie;?>" >
				<span  <?php if($movie_name==$movie)
                    echo "style='background-color:yellow;text-align:center;width:200px'";
                ?>><?php echo  Html::a($movie,
                            ['query-schedule', 'cinema_no' => $cinema_no,'cinema_name' => $cinema_name,'movie_name' => $movie],
                            [
                                'class' => '',
                            ]
                        );?>
                    </dd>
                <?php }}?>

        </dl>
    </div>
</div>
<!-- 左侧导航 end -->
<!-- 右侧内容 start -->
<div class="right-contents" style="float: right">
    <div class="sy-list-nav">
        <?php
        $key=-1;

        if(!empty($show_date)&&$show_date){
            foreach ($show_date as $day){
                $key++; ?>
                <ul id="dateul">
                    <li id="dataclass<?php echo $key;?>"
                        onclick="selectDate(<?php echo $key;?>)"><?php echo $day;?></li>
                </ul>
            <?php }}?>
    </div>
    <?php for ($i=0;$i<count($show_date);$i++){
        ?>
        <div id="<?php echo "div".$i;?>">
            <table id="list" border="0" cellspacing="0" cellpadding="0"
                   class="table table-striped" width="10%">
                <tr>
                    <th>排期ID</th>
                    <th>&nbsp;&nbsp;场次时间&nbsp;&nbsp;</th>
                    <th   title ="系统商状态/批价状态">状态</th>
                    <th>语言/版本</th>
                    <th>影厅</th>
                    <th  title ="平台/影院/订座系统">&nbsp;&nbsp;费用&nbsp;&nbsp;</th>
                    <th>结算价</th>
                    <th>售卖价</th>
                    <th>门市价</th>
                    <th>销售价</th>
                    <th>最低价</th>
                    <th>系统商</th>


                    <tbody id="bodylist">
                    <?php
                    if(is_array($schedule[$i])&&$schedule[$i]){
                        foreach ($schedule[$i] as  $value) {

                            ?>
                            <tr>
                                <td><?php echo $value['baseScheduleId'];?></td>
                                <td><?php
                                    if (strlen($value['showTime']) == 4) {
                                        $time = substr($value['showTime'], 0, 2) . ':' . substr($value['showTime'], 2, 2);
                                    } elseif(strlen($value['showTime']) == 3) {
                                        $time = '0' . substr($value['showTime'], 0, 1) . ':' . substr($value['showTime'], 1, 2);
                                    }else{
                                        $time = '00:00';
                                    }
                                    echo date('Y-m-d ', substr($value['showDate'], 0, - 3)).$time;?></td>

                                <td   title ="<?php echo (($value['scheduleStatus']==0)?"系统商状态正常":(($value['scheduleStatus']==9)?"系统商状态停售":"系统商状态未定价")).'/'.(($value['priceStatus']==0)?"排期状态正常":"排期状态无效");?>"><?php echo ($value['scheduleStatus']==9||$value['priceStatus']==1)?"停售":"正常"?></td>
                                <td><?php echo $value['language'].'/'.$value['showType'];?></td>
                                <td><?php echo $value['hallName'];?></td>
                                <td><?php echo $value['openSystemFee']."/".$value['cinemaFee']."/".$value['bookingSystemFee'];?></td>
                                <td><?php echo $value['settlementPrice'];?></td>
                                <td><?php echo $value['actualSellPrice'];?></td>
                                <td><?php echo $value['cinemaPrice'];?></td>
                                <td><?php echo $value['salePrice'];?></td>
                                <td><?php echo $value['lowestPrice'];?></td>
                                <td><?php
                                    switch ($value['bisId']) {
                                        case '5382dbb7d7ae6f1d48cf2db2':
                                            echo '金逸';
                                            break;
                                        case '5382dbb8d7ae6f1d48cf2db4':
                                            echo '火凤凰';
                                            break;
                                        case '545893212bc3abad3154fcb0':
                                            echo '满天星';
                                            break;
                                        case '545893212bc3abad3154fcb3':
                                            echo '鼎新';
                                            break;
                                        case '545893212bc3abad3154fcb6':
                                            echo '万达';
                                            break;
                                        case '545893212bc3abad3154fcb9':
                                            echo '幸福蓝海';
                                            break;
                                        case '545893212bc3abad3154fcbc':
                                            echo '大地';
                                            break;
                                        case '545893212bc3abad3154fcbf':
                                            echo '天下票仓';
                                            break;
                                        case '545893212bc3abad3154fcc2':
                                            echo '辰星';
                                            break;
                                        case '545893212bc3abad3154fcc5':
                                            echo 'VISTA';
                                            break;
                                        case '545893212bc3abad3154fcc8':
                                            echo '卢米埃';
                                            break;
                                        case '545893212bc3abad3154fcc9':
                                            echo '星美';
                                            break;
                                        case '545893212bc3abad3154fcca':
                                            echo '美嘉';
                                            break;
                                        case '545893212bc3abad3154fccb':
                                            echo '易得';
                                            break;
                                        case '545893212bc3abad3154fccc':
                                            echo '1905';
                                            break;
                                        case '545893547bc3abad3154fcd1':
                                            echo '中影';
                                            break;
                                        case '545893547bc3abad3154fcd2':
                                            echo '深圳UL';
                                            break;
                                        case '545893547bc3abad3154fcd3':
                                            echo '传奇时代';
                                            break;
                                        case '545893547bc3abad3154fcd4':
                                            echo '幸福蓝海V1';
                                            break;
                                        case '545893547bc3abad3154fcd5':
                                            echo '浙江时代';
                                            break;
                                        case '545893547bc3abad3154fcd6':
                                            echo '火烈鸟';
                                            break;
                                        case '545893547bc3abad3154fcd7':
                                            echo '联通天脉';
                                            break;
                                        default:
                                            echo '未知系统';
                                            break;
                                    }?></td>
                            </tr>
                        <?php }}else{}?>
                    </tbody>
            </table>

        </div>
    <?php }?>
</div>
<!-- 右侧内容 end -->
<script type="text/javascript">
    var len=<?php echo count($show_date); ?>;

//    setTimeout(function () {
//        for(var i=0;i<len;i++){
//            console.log("test:"+i);
//            if(i==0){
//                $('#div'+i).show();
//                $('#dataclass'+i).attr('style','background-color:green');
//            }else{
//                $('#div'+i).hide();
//                $('#dataclass'+i).attr('style','');
//            }
//        }
//    },200);

    $(document).ready(function(){
        for(var i=0;i<len;i++){
            console.log("test:"+i);
            if(i==0){
                $('#div'+i).show();
                $('#dataclass'+i).attr('style','background-color:green');
            }else{
                $('#div'+i).hide();
                $('#dataclass'+i).attr('style','');
            }
        }
    })
    function selectDate(key){

        for(var i=0;i<len;i++){
            if(i==key){
                $('#div'+i).show();
                $('#dataclass'+i).attr('style','background-color:green');
            }else{
                $('#div'+i).hide();
                $('#dataclass'+i).attr('style','');
            }
        }
    }

</script>
<style>
    .control-group{
        width:100%;
        height:60px;
        background-color: rgba(38, 255, 225, 0);
    }
    .control-label {
        float: left;
        padding-top: 5px;
        text-align: center;
        width: 260px;
    }
    .sy-list-nav ul li{
        float: left;
        display: block;
        min-width: 100px;
        padding:0px 10px;
        height: 39px;
        text-align: center;
        background:#f9f9f9;
        margin-right: 5px;
        line-height: 38px;
        cursor: pointer;
        border-top: 1px solid #707070;
        border-left: 1px solid #707070;
        border-right: 1px solid #707070;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }

    .x_aside {
        width: 20%;
        float: left;
        background: #fff;
        z-index: 2;
        position: relative;
        display: block;
        min-height: 100px;

    }
    .contents {
        width: 1198px;
        margin: 0 auto;
    }


    .x_asideDIV {
    }
    .x-menu-l {
        font-size: 16px;
        color: #515151;
        margin: 0;
    }

    .x-menu-l dt, .x-menu-l dd {
        height: 40px;
        border-left: 1px solid #9c9c9c;
        border-right: 1px solid #9c9c9c;
    }

    .x-menu-l dt {
        background: #f3f3f3;
    }

    .x-menu-l dt span, .x-menu-l dd span {
        display: block;
        border-top: 1px solid #fff;
        height: 38px;
        line-height: 38px;
    }

    .x-menu-l dt span {
        padding-left: 20px;
        border-bottom: 1px solid #9c9c9c;
        background: url(../images/x-icn.png) no-repeat right 0px;
    }

    .x-menu-l dd {
        background-color: #fff;
        cursor: pointer;
        margin: 0
    }

    .x-menu-l dd span {
        padding-left: 25px;
        font-size: 12px;
        border-bottom: 1px solid #9c9c9c;
    }

    .x-menu-l dd.cur {
        border-left: 3px solid #6ad000;
        border-right: 1px solid #fff;
        background-color: #fff;
        margin: 0
    }

    .x-menu-l dd.cur span {
        padding-left: 23px;
    }
    .x-CustomerInformation {
        text-align: left;
        font-size: 14px;
        padding:40px 10px;
        color: #333;
        border-bottom: 1px solid #9c9c9c;
        border-right: 1px solid #9c9c9c;
        border-left: 1px solid #9c9c9c;
        line-height: 20px;
        ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½word-wrap:break-word;
    }
    .x-CustomerInformation span{
        font-size: 16px;
        font-weight: bold;
    }
    .x_aside {
        width: 20%;
        float: left;
        background: #fff;
        z-index: 2;
        position: relative;
        display: block;
        min-height: 100px;

    }

    .btn-success {
        color: #ffffff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: #5bb75b;
        *background-color: #51a351;
        background-image: -moz-linear-gradient(top, #62c462, #51a351);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
        background-image: -webkit-linear-gradient(top, #62c462, #51a351);
        background-image: -o-linear-gradient(top, #62c462, #51a351);
        background-image: linear-gradient(to bottom, #62c462, #51a351);
        background-repeat: repeat-x;
        border-color: #51a351 #51a351 #387038;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
    }

    .right-contents {
        width: 79%;
        /*padding: 20px;*/
        border-left: 1px solid #9c9c9c;
        float: left;
        /*margin-left: -1px;*/
        min-height: 400px;
    }
</style>