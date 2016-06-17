<?php

namespace backend\controllers;
use Yii;
use backend\models;
use backend\models\SmartCinema;
use backend\models\SmartSchedule;

class ScheduleController extends \yii\web\Controller
{
    public function actionQuery()
    {
        $searchModel = new SmartCinema();
        $dataProvider = $searchModel->oSearch(Yii::$app->request->queryParams);
        return $this->render('query',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionStatistics(){
        $statisticInfo=SmartSchedule::getStatistic();

       return $this->render('statistics',['schedule_list'=>$statisticInfo['schedule_list'],
           'total_num'=>$statisticInfo['total_num'],
           'stop_num'=>$statisticInfo['stop_num'],
           'top_schedule_list'=>$statisticInfo['top_schedule_list']]);
    }
    public function actionQuerySchedule(){

        $schedule=SmartSchedule::getScheduleInfo(Yii::$app->request->queryParams);
        return $this->render('schedule',[
            'cinema_no'  => $schedule['cinema_no'],
            'cinema_name' => $schedule['cinema_name'],
            'schedule' => $schedule['schedule'],
            'movie_list' => $schedule['movie_list'],
            'show_date' => $schedule['show_date'],
            'movie_name'=> $schedule['movie_name']
        ]);
    }
}
