<?php

namespace backend\controllers;

use backend\models\SmartPriceDiscount;
use backend\models\SmartCinema;
use backend\models\SmartFilm;
use backend\models\SmartHall;
use backend\controllers\CommonController;
use Yii;

class DiscountController extends CommonController
{

    public function init(){
        parent::init();
        $this->enableCsrfValidation = false;
        // 检查操作员是否有对本功能操作的权限

    }

    public function actionList(){
        $searchModel = new SmartPriceDiscount();
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
    public function actionEdit(){
        $param=Yii::$app->request->queryParams;
        $discountInfo=SmartPriceDiscount::agetDiscountInfoById($param);

        if(!$discountInfo){
            echo "<script> alert('无此活动信息'); history.go(-1);</script>";
        }
        if(isset($param['copy'])){
            return $this->render('copy',['discountInfo'=>$discountInfo]);
        }
        return $this->render('edit',['discountInfo'=>$discountInfo]);
    }
    /*
    * 删除活动列表
    *
    */
    public function actionDelete(){
        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceDiscount::model()->bDeleteDiscount($pc_id);
            if($res)
                return $this->redirect(['discount/list']);

        }else{
            return $this->redirect(['discount/list']);
        }
    }


    /*
    * 开启活动
    *
    */
    public function actionStart(){

        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceDiscount::model()->bStartDiscount($pc_id);
            if($res)
                return $this->redirect(['discount/list']);

        }else{
            return $this->redirect(['discount/list']);
        }
    }

    /*
    * 暂停活动
    *
    */
    public function actionStop(){

        $pc_id = Yii::$app->request->get('id');
        if(intval($pc_id)){
            $res = SmartPriceDiscount::model()->bStopDiscount($pc_id);
            if($res)
                return $this->redirect(['discount/list']);

        }else{
            return $this->redirect(['discount/list']);
        }
    }
    /*
     * 编辑活动
     */
    public function actionUpdate(){
        $postData = Yii::$app->request->post();
        if(isset($postData['copy'])){
            $res = SmartPriceDiscount::model()->saveDiscount($postData);
        }else{
            $res = SmartPriceDiscount::model()->updateDiscount($postData);
        }

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
        $discountInfo = SmartPriceDiscount::model()->aGet($pdId);
        return $this->render('view',['discountInfo'=>$discountInfo]);
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
