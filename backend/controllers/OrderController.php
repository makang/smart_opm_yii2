<?php

namespace backend\controllers;

use backend\models\SmartOrders;
use backend\models\SmartPriceDiscountOrder;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionActivity()
    {
        $searchModel = new SmartPriceDiscountOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartOrders::getStatus();
        return $this->render('activity', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionMember(){
        $searchModel = new SmartPriceDiscountOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartOrders::getStatus();
        return $this->render('activity', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,

        ]);
    }
}
