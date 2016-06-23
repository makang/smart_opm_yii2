<?php

namespace backend\controllers;

use backend\models\SmartOrders;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class MovieController extends Controller
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
    public function actionOrder(){
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
