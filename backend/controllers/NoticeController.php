<?php

namespace backend\controllers;

class NoticeController extends \yii\web\Controller
{
    public function actionList()
    {
        return $this->render('list');
    }

}
