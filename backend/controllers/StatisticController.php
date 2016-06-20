<?php

namespace backend\controllers;

use Yii;
use backend\models\SmartPublicsignalStatistics;
use backend\models\SmartOrderStatistic;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatisticController implements the CRUD actions for SmartPublicsignalStatistics model.
 */
class StatisticController extends Controller
{
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
