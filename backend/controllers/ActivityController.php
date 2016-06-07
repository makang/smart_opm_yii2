<?php

namespace backend\controllers;

class ActivityController extends \yii\web\Controller
{
    public function actionList()
    {
        return $this->render('list');
    }

}
