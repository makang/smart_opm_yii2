<?php

namespace backend\controllers;

use Yii;
use backend\models\SmartPublicsignalStatistics;
use backend\models\SmartOrderStatistic;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\CommonController;

/**
 * StatisticController implements the CRUD actions for SmartPublicsignalStatistics model.
 */
class StatisticController extends CommonController
{
    protected $mo       =   'SmartOrderStatistic';
    public    $param    =   '';
    /**
     * @inheritdoc
     */
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

    //列表页条件查询
    public function _map(){
        $where = '';
        if(Yii::$app->request->get('day')) $where .= "order_day='".Yii::$app->request->get('day')."' and ";
        return $where?substr($where,0,-5):'';
    }


    /**
     * Lists all SmartPublicsignalStatistics models.
     * @return mixed
     */
    public function actionPublic()
    {
        $searchModel = new SmartPublicsignalStatistics();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
       
        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionOrder()
    {
        $searchModel = new SmartOrderStatistic();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        return $this->render('order', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
