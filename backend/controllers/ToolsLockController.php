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


class ToolsLockController  extends CommonController{

    public function init(){
    	parent::init();
        $this->enableCsrfValidation = false;
    	// 检查操作员是否有对本功能操作的权限

    }

    public function actionIndex(){




       return $this->render('index',['output'=>'123']);
    }
}
 
 
 ?>