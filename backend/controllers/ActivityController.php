<?php
/**
 * @date  2016-1-4
 * @description 老活动列表
 * @author cyt
 * @copyright 2016
 * @since 1.0
 */
namespace backend\controllers;
use backend\models\SmartPriceCut;
use Yii;
use backend\controllers\CommonController;
use backend\models\OpenBasePublicsignal;
use backend\models\Article;
use backend\models\ArticleSearch;

class ActivityController  extends CommonController{


    public function init(){
    	parent::init();
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



}
 
 
 ?>