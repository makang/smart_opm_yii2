<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Article;
use backend\models\SmartCinema;
use yii\widgets\ActiveForm;
?>



<link rel="stylesheet" href="/assets_ace/css/chosen.css" />
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">

            <div class="row">
                <div class="col-sm-10">
                    <div id="sample-table-2_length" class="dataTables_length">

                        <?php $form = ActiveForm::begin([
                            'action' => ['list'],
                            'method' => 'get',
                        ]); ?>

                        <span class="input-icon align-middle" >
                           <select name="PublicSignalTheme" style="width: 150px">
                               <option value="0">选择合作主题</option>;
                               <?php

                               foreach($theme as $k=>$v){
                                   echo '<option value="'.$k.'">'.$v.'</option>';
                               }
                               ?>

                           </select>
                        </span>
                        <span class="input-icon align-middle" >
                           <select name="CooperationStatus" style="width: 150px">
                               <option value="0">选择合作状态</option>;
                               <?php

                               foreach($coor as $k=>$v){
                                   echo '<option value="'.$k.'">'.$v.'</option>';
                               }
                               ?>

                           </select>
                        </span>



                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="PublicSignalName" class="search-query" placeholder="公众号" value="<?= !empty($_REQUEST['PublicSignalName'])?$_REQUEST['PublicSignalName']:'' ?>"/>
                        </span>

                        <span class="input-icon align-middle">
                            <i class="icon-search"></i>
                            <input type="text" name="PublicSignalNickname" class="search-query" placeholder="公司名称" value="<?= !empty($_REQUEST['PublicSignalNickname'])?$_REQUEST['PublicSignalNickname']:'' ?>"/>
                        </span>



                            <div class="btn-group">

                            </div>
                            <span></span>
                            <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= Html::a('新增',['add'], ['class' => 'btn btn-sm btn-info']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="space-6"></div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}\n{summary}",
                'summary' => '<p class="summary">当前显示第{begin} - {end}条，共{totalCount}条。</p>',
                'pager'=>[
                    //'options'=>['class'=>'hidden']//关闭分页
                    'firstPageLabel'=>"第一页",
                    'prevPageLabel'=>'上一页',
                    'nextPageLabel'=>'下一页',
                    'lastPageLabel'=>'最后一页',
                ],
                'columns' => [

                    ['label'=>'微信公众号','value'=>'PublicSignalName'],
                    ['label'=>'类型','value'=>function($row){
                        return \backend\models\SmartPublicSignal::model()->sGetThemeDesc($row['PublicSignalTheme']);
                    }],
                    ['label'=>'注册公司名称','value'=>'PublicSignalNickname'],
                    ['label'=>'合作状态','value'=>function($row){
                        return \backend\models\SmartPublicSignal::model()->sGetCoorStatus($row['CooperationStatus']);
                    }],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{detail} ',
                        'headerOptions' => ['width' => '170'],
                        'buttons' => [
                            'detail' => function($url, $row, $key){


                            }
                        ],
                    ]

                ],
            ]); ?>




        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="/assets_ace/js/jquery-ui-1.10.3.full.min.js"></script>


<script type="text/javascript">
    jQuery(function($) {


    });



</script>


<div id="dialog-confirm" class="hide">
    <div class="alert alert-info bigger-110">
       一旦删除则永久不能回复
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        确定删除？
    </p>
</div><!-- #dialog-confirm -->



