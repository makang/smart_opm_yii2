<?php

namespace backend\controllers;

class ScheduleController extends \yii\web\Controller
{
    public function actionQuery()
    {
        return $this->render('query');
    }

}
