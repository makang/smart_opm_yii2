<?php

namespace backend\controllers;

use backend\models\SmartOrders;
use backend\models\SmartMemberOrder;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class MemberController extends Controller
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
        $searchModel = new SmartMemberOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartOrders::getStatus();
        return $this->render('member', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,

        ]);
    }
}
