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
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;
use backend\models\Article;
use backend\models\ArticleSearch;


class ActivityController  extends CommonController{


    public function init(){
    	parent::init();
        $this->enableCsrfValidation = false;
    	// 检查操作员是否有对本功能操作的权限
    	
    }

 	public function actionList(){
        $searchModel = new SmartPriceCut();
        $dataProvider   = $searchModel->oSearch(Yii::$app->request->queryParams);
        $activityStatus = $searchModel::$_STATUS_SHOW;
        return $this->render('list', [
            'dataStatus'   => $activityStatus,
            'dataProvider'  => $dataProvider
        ]);
    }


    public function actionAdd(){
        return $this->render('add');
    }

    /*
    * 删除活动列表
    *
    */
    public function actionDelete(){
        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());
        $jumpUrl    =   'activity/list?'.$params;
        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceCut::model()->bDelActivity($pc_id);
            if($res)$this->jump($jumpUrl);
        }else{
            $this->jump($jumpUrl);
        }
    }


    /*
    * 开启活动
    *
    */
    public function actionStart(){
        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());
        $jumpUrl    =   'activity/list?'.$params;
        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceCut::model()->bStartActivity($pc_id);
            if($res)$this->jump($jumpUrl);
        }else{
            $this->jump($jumpUrl);
        }
    }

    /*
    * 暂停活动
    *
    */
    public function actionStop(){
        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());
        $jumpUrl    =   'activity/list?'.$params;
        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceCut::model()->bStopActivity($pc_id);
            if($res)$this->jump($jumpUrl);

        }else{
            $this->jump($jumpUrl);
        }
    }


    /*
    * 保存活动
    *
    */
    public function actionSave(){
        $postData = Yii::$app->request->post();
        $res = SmartPriceDiscount::model()->saveDiscount($postData);
        if($res){
            $this->AjaxError('保存成功',$this->_CODE['SUC']);
        }else{
            $this->AjaxError('保存失败',$this->_CODE['FAILED']);
        }

    }

    /*
    * 保存活动
    *
    */
    public function actionDetails(){
        $pdId = Yii::$app->request->get('id');
        $res = SmartPriceDiscount::model()->aGet($pdId);
        return $this->render('detail');
    }


    public function actionAjaxGetCinema(){
        $keyword = Yii::$app->request->get('key');
        if(!$keyword){
            $this->AjaxError('请输入关键字',$this->_CODE['NOPARAM']);
        }
        $cinema['cinema']   = SmartCinema::model()->aGetCinemaNoByName($keyword);
        $cinema['hall']     = SmartHall::model()->aGetHallByCinemaNos(array_keys($cinema['cinema']));
        $this->output($cinema);
    }


    public function actionAjaxGetFilm(){
        $keyword = Yii::$app->request->get('key');
        if(!$keyword){
            $this->AjaxError('请输入关键字',$this->_CODE['NOPARAM']);
        }
        $film['film']   = SmartFilm::model()->aGetFilmsByName($keyword);
        $this->output($film);
    }




}
 
 
 ?>