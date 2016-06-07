<?php

namespace backend\controllers;

class CinemaConfigController extends \yii\web\Controller
{
    public function actionList()
    {
        return $this->render('list');
    }

}
