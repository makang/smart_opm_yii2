<?php

namespace backend\controllers;

class PublicmanageController extends \yii\web\Controller
{
    public function actionOrder()
    {
        return $this->render('order');
    }

}
