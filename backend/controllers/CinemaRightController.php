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
use backend\models\SmartCinemaPersonalConfig;
use backend\models\SmartFilm;
use backend\models\SmartHall;
use backend\models\SmartPriceCut;
use backend\models\SmartPriceDiscount;
use backend\models\SmartPublicSignal;
use backend\models\SmartPublicSignalCinema;
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;


class CinemaRightController  extends CommonController{
    protected $mo       =   'SmartCinemaPersonalConfig';
    public    $param    =   '';
    public function init(){
    	parent::init();
        $this->enableCsrfValidation = false;
        $this->param['bookingSystem']   = SmartCinemaPersonalConfig::$_BOOKINGSYSTEM_DESC;
        $this->param['suitStatus']      = SmartCinemaPersonalConfig::$_SUITSTATUS_DESC;
        $this->param['suitCodeEnc']     = SmartCinemaPersonalConfig::$_CODEENC_DESC;
    }


    //列表页条件查询
    public function _map(){
        $where = '';
        if(Yii::$app->request->get('cinema_no')){

            $cinema = new SmartCinema();
            $ids = $cinema->aGetCinemaNoByName(Yii::$app->request->get('cinema_no'));
            $ids = array_keys($ids);

            $where .='cinema_no  in ('.implode(',',$ids).') and ';
        };
        return $where?substr($where,0,-5):'';
    }


    //新增影院属性
    public function actionInsert(){
        $data = Yii::$app->request->post();
        $res = SmartCinemaPersonalConfig::model()->bSave($data,$data['cinema_no']);
        if($res)$this->redirect('/cinema-right/list');
    }

    //涉及到价格计算，需要独立出来实例
    public function actionSave(){
        $data = Yii::$app->request->post();
        $res = SmartCinemaPersonalConfig::model()->bSave($data,$data['cinema_no']);
        if($res)$this->redirect('/cinema-right/list');
    }

}
 
 
 ?>