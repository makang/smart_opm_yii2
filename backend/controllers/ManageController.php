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
use backend\models\SmartPublicSignalCinema;
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;
use backend\models\Article;
use backend\models\ArticleSearch;


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





    //绑定/解绑
    public function actionBind(){
        $id = Yii::$app->request->get('id');
        $param['publicSignal'] = SmartPublicSignal::model()->oGet($id);
        $param['PublicSignalCinemas'] = SmartPublicSignalCinema::model()->aGetCinemasByPid($param['publicSignal']->Id);
        return $this->render('bind',$param);
    }


    //解除影院绑定
    public function actionUnbindCinema(){

        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());
        $jumpUrl    =   'manage/bind?'.$params;

        $cinemaNo   = Yii::$app->request->get('cinemaNo');
        $pid        = Yii::$app->request->get('pid');
        $ret        = SmartPublicSignalCinema::model()->bUpdateCancel($pid,$cinemaNo);
        if($ret){
            $this->jump($jumpUrl);
        }

    }

    //影院绑定
    public function actionBindCinema(){

        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());
        $jumpUrl    =   'manage/bind?'.$params;

        $cinemaNo   = Yii::$app->request->get('cinemaNo');
        $pid        = Yii::$app->request->get('pid');
        $ret        = SmartPublicSignalCinema::model()->bUpdateBind($pid,$cinemaNo);
        if($ret){
            $this->jump($jumpUrl);
        }

    }




    //列表页条件查询
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