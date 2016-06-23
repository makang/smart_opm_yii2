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

        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">
                    <i class="icon-signal"></i>
                    售票总金额
                </h4>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="icon-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4" style="width:900px;height:300px">
                    <canvas id="money" ></canvas>
                    <canvas id="num" ></canvas>
                    <canvas id="per" ></canvas>
                </div><!-- /widget-main -->
            </div><!-- /widget-body -->
        </div><!-- /widget-box -->



    </div><!-- /span -->
</div><!-- /row -->



<!--[if !IE]> -->


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/assets_ace/js/Chart.js"></script>

<script type="text/javascript">
    var data = <?=$total;?>;
    var label = [];
    var money = [];
    var num   = [];
    var per   = [];

    for(prv in data){
        label.push(data[prv]['n'].substring(4))
        money.push(data[prv]['pay_money']);
        num.push(data[prv]['num']);
        per.push(data[prv]['per']);
    }



    createLine(label,'gmv',money,"money");
    createLine(label,'订单数',num,"num");
    createLine(label,'客单价',per,"per");

    function createLine(label,labelName,data,id){
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
        };
        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };
        var config = {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: labelName,
                    data: data,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom'
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '元'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '日期'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: labelName
                }
            }
        };

        $.each(config.data.datasets, function(i, dataset) {
            var background = randomColor(0.5);
            dataset.borderColor = background;
            dataset.backgroundColor = background;
            dataset.pointBorderColor = background;
            dataset.pointBackgroundColor = background;
            dataset.pointBorderWidth = 1;
        });
        var ctx = $('#'+id).get(0).getContext("2d");
        new Chart(ctx,config);

    }



</script>





