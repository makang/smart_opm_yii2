<?php

namespace backend\controllers;

use backend\models\SmartSuitOrder;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SuitController extends Controller
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
        $searchModel = new SmartSuitOrder();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        $orderStatus = SmartSuitOrder::getStatus();
        return $this->render('suit', [
            'dataStatus'   => $orderStatus,
            'dataProvider' => $dataProvider,
        ]);
    }

}
