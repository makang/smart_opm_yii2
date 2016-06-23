<?php

namespace backend\controllers;

use backend\models\SmartOrders;
use backend\models\SmartPriceDiscountOrder;
use backend\models\SmartMemberOrder;
use backend\models\SmartSuitOrder;
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
        $searchModel = new SmartMemberOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartOrders::getStatus();
        return $this->render('member', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionSuit(){
        $searchModel = new SmartSuitOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartSuitOrder::getStatus();
        return $this->render('suit', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMovie(){
        $searchModel = new SmartOrders();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartOrders::getStatus();
        $discountType= SmartOrders::getDiscountType();
        return $this->render('movie', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,
            'discountType' => $discountType
        ]);
    }
}
