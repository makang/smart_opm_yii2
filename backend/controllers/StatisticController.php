<?php

namespace backend\controllers;

class StatisticController extends \yii\web\Controller
{
    public function actionActivity()
    {
        return $this->render('activity');
    }

}
