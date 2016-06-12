<link rel="stylesheet" href="/assets_ace/css/chosen.css" />
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
            <div class="col-xs-6 col-sm-10 pricing-box col-sm-offset-1">
                <div class="widget-box">
                    <div class="widget-header header-color-orange">
                        <h5 class="bigger lighter">我的营收</h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td> <i class="icon-ok green"></i>
                                        电影票：</td><td><?php echo ($list['ticket_money']+0)/100;?></td>

                                    <td> <i class="icon-ok green"></i>
                                        卖品：</td><td><?php echo ($list['suit_money']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        充值</td><td><?php echo ($list['enc_money']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        会员卡购票</td><td><?php echo ($list['mem_money']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        退款</td><td><?php echo ($list['refund_money']+0)/100;?></td>

                                    <td><i class="icon-ok green"></i>
                                        总计</td><td><?php

                                        echo ($list['ticket_money']+$list['suit_money']+$list['enc_money']+$list['mem_money']
                                                +$list['refund_money'])/100
                                        ?></td>

                                    <td>
                                        <button class="btn btn-minier btn-yellow">确定对账</button>

                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-10 pricing-box col-sm-offset-1">
                <div class="widget-box">
                    <div class="widget-header header-color-blue">
                        <h5 class="bigger lighter">我的手续费</h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td> <i class="icon-ok green"></i>
                                        电影票：</td><td><?php echo ($list['ticket_fee']+0)/100;?></td>

                                    <td> <i class="icon-ok green"></i>
                                        卖品：</td><td><?php echo ($list['suit_fee']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        充值</td><td><?php echo ($list['enc_fee']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        会员卡购票</td><td><?php echo ($list['mem_fee']+0)/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        微信手续费</td><td><?php echo ($list['order_fee'])/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        微信退款手续费</td><td><?php echo ($list['refund_fee'])/100;?></td>
                                    <td><i class="icon-ok green"></i>
                                        总计</td><td><?php
                                        echo ($list['ticket_fee']+$list['suit_fee']+$list['mem_fee']+$list['order_fee']
                                                +$list['refund_fee'])/100;
                                        ?></td>

                                    <td>
                                        <button class="btn btn-minier btn-yellow">确定对账</button>

                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>


    </div><!-- /.col -->
</div>

<!--上传区域-->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="alert alert-info">
            <i class="icon-hand-right"></i>

            上传对账单
            <button class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
            </button>
        </div>

        <div id="dropzone">
            <form class="dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple="" />
                </div>
            </form>
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->



<script type="text/javascript">
    window.jQuery || document.write("<script src='/assets_ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<link rel="stylesheet" href="/assets_ace/css/dropzone.css" />
<script src="/assets_ace/js/dropzone.min.js"></script>
<link rel="stylesheet" href="/assets_ace/css/ace.min.css" />
<script type="text/javascript">
    jQuery(function($){

        try {
            $(".dropzone").dropzone({
                paramName: "file",
                maxFilesize: 0.5,
                url:'upload',
                method:'post',
                acceptedFiles:'image/*,application/pdf,.psd,.obj',



                addRemoveLinks : true,
                dictDefaultMessage : '<span class="bigger-150 bolder"><i class="icon-caret-right red"></i> 拖拽</span> 上传 \
				<span class="smaller-80 grey">(或者点击上传)</span> <br /> \
				<i class="upload-icon icon-cloud-upload blue icon-3x"></i>',
                dictResponseError: '',
                dictRemoveFile:'删除',
                //change the previewTemplate to use Bootstrap progress bars
                previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",


                init: function() {
                    this.on("success", function(file,response) {
                        console.log("File " + file.name + "uploaded"+response);
                    });
                    this.on("removedfile", function(file) {
                        console.log("File " + file.name + "removed");
                    });
                }

            });
        } catch(e) {
            alert('不支持旧版浏览器上传');
        }

    });
</script>



