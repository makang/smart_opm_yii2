<?php

namespace backend\controllers;

use backend\models\SmartSchedule;

class ScheduleController extends \yii\web\Controller
{
    public function actionQuery()
    { 
        return $this->render('query');
    }
    public function actionStatistics(){
        $statisticInfo=SmartSchedule::getStatistic();

       return $this->render('statistics',['schedule_list'=>$statisticInfo['schedule_list'],
           'total_num'=>$statisticInfo['total_num'],
           'stop_num'=>$statisticInfo['stop_num'],
           'top_schedule_list'=>$statisticInfo['top_schedule_list']]);
    }
    public function actionSchedulequery(){

    }
}
