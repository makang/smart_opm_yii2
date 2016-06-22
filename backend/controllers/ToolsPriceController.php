<?php
/**
 * @date  2016-1-4
 * @description 老活动列表
 * @author cyt
 * @copyright 2016
 * @since 1.0
 */
namespace backend\controllers;
use backend\models\SmartChildAccount;
use backend\models\SmartCinema;
use backend\models\SmartFilm;
use backend\models\SmartHall;
use backend\models\SmartPriceCut;
use backend\models\SmartPriceDiscount;
use backend\models\SmartPublicSignal;
use backend\models\SmartPublicSignalCinema;
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;
use backend\extensions\Curl;


class ToolsPriceController  extends CommonController{

    public function init(){
    	parent::init();
        $this->enableCsrfValidation = false;
    	// 检查操作员是否有对本功能操作的权限

    }

    public function actionIndex(){

        $outPut			= '';
        $parameters		= array();
        $errorMsg		= '';
        $discountId		= intval(Yii::$app->request->get('pdId'));
        $type			= intval(Yii::$app->request->get('type'));
        $idValue		= trim(Yii::$app->request->get('value'));

        if(Yii::$app->request->get()){
            if($discountId < 1){
                $errorMsg							= '优惠活动ID错误';
            }else{
                $parameters['discount_id'] 			= $discountId;
                if(empty($idValue)){
                    $errorMsg						= '排期或订单id错误';
                }else{
                    if($type == '0'){
                        $parameters['schedule_id'] 	= $idValue;
                    }else{
                        $parameters['orderid'] 		= $idValue;
                    }

                    $url		= Yii::$app->params['cgi_domain'].'/tools/discountPrice';

                    Curl::curlPost($url, $parameters,$return);
                    if(is_array($return) && !empty($return)){
                        if($return['msg'] != ''){
                            $errorMsg	= $return['msg'];
                        }else{
                            $outPut = $return['data']['content'];
                        }
                    }else{
                        $errorMsg	= '数据处理失败，请重新提交数据';

                    }
                }
            }
        }




       return $this->render('index',['msg'=>$errorMsg,'output'=>$outPut]);
    }
}
 
 
 ?>