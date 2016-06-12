<?php
/**
 * @date  2016-1-4
 * @description 对账
 * @author cyt
 * @copyright 2016
 * @since 1.0
 */
namespace backend\controllers;
use Yii;
use backend\controllers\CommonController;
use backend\models\SmartTongjiWxOrder;
use backend\models\OpenBasePublicsignal;
use backend\models\Article;
use backend\models\ArticleSearch;

class BillController  extends CommonController{


    public function init(){
    	parent::init();
    	// 检查操作员是否有对本功能操作的权限
    	
    }

 	public function actionIndex(){
        $publicSignal = OpenBasePublicsignal::model()->aGetAllPublicSignal();
        $searchModel = new SmartTongjiWxOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'publicSignal'  =>$publicSignal
        ]);
    }

    public function actionDetails(){
        $searchModel = new SmartTongjiWxOrder();
        $dataProvider = $searchModel->oSearchDetail(Yii::$app->request->queryParams);

        return $this->render('detail', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider
        ]);
    }


    public function actionCollate(){
        $searchModel = new SmartTongjiWxOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);

        $model = $dataProvider->models;
        return $this->render('collate', [
            'searchModel'   => $searchModel,
            'list'  => $model[0]
        ]);
    }

    public function actionDownload(){
        $date           =  Yii::$app->request->get('date');
        $cinemaNo       =  Yii::$app->request->get('cinema_no');
        $list = SmartTongjiWxOrder::model()->aGetRawWxData($cinemaNo,$date);
        header("Content-type:application/vnd.ms-excel;charset=UTF-8");
        header("Content-Disposition:attachment;filename=".$date.".xls");
        $column = array('交易时间	','公众账号ID','商户号','子商户号','设备号','微信订单号','商户订单号','用户标识','交易类型',
            '交易状态','付款银行','货币种类','总金额','企业红包金额','微信退款单号','商户退款单号','退款金额','企业红包退款金额','退款类型',
            '退款状态','商品名称','商户数据包','手续费','费率');
        echo SmartTongjiWxOrder::model()->sGenerateBlank($list,$column);


    }



}
 
 
 ?>