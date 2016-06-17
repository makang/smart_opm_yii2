<?php
/**
 * @date  2016-1-4
 * @description 老活动列表
 * @author cyt
 * @copyright 2016
 * @since 1.0
 */
namespace backend\controllers;
use backend\models\SmartCinema;
use backend\models\SmartFilm;
use backend\models\SmartHall;
use backend\models\SmartPriceCut;
use backend\models\SmartPriceDiscount;
use backend\models\SmartPublicSignal;
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;


class ManageController  extends CommonController{
    protected $mo       =   'SmartPublicSignal';
    public    $param    =   '';
    public function init(){
    	parent::init();
        $this->enableCsrfValidation = false;
    	// 检查操作员是否有对本功能操作的权限
        $this->param['theme'] = SmartPublicSignal::$_THEME_DESC;
        $this->param['coor'] = SmartPublicSignal::$_COOR_DESC;
    }


    public function _map(){
        $where = '';
        if(Yii::$app->request->get('PublicSignalTheme')){
            $where .='PublicSignalTheme = "'. Yii::$app->request->get('PublicSignalTheme').'" and ';
        };
        if(Yii::$app->request->get('CooperationStatus')){
            $where .='CooperationStatus = "'. Yii::$app->request->get('CooperationStatus').'" and ';
        };
        if(Yii::$app->request->get('PublicSignalName')){
            $where .='PublicSignalName like "%'. Yii::$app->request->get('PublicSignalName').'%" and ';
        };
        if(Yii::$app->request->get('PublicSignalNickname')){
            $where .='PublicSignalNickname like "%'. Yii::$app->request->get('PublicSignalNickname').'%" and ';
        };
        return $where?substr($where,0,-5):'';
    }


}
 
 
 ?>