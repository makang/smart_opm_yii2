<?php

namespace backend\controllers;

use app\models\OpmOpSystemNotice;

class NoticeController extends \yii\web\Controller
{
    public function actionList()
    {
        $model=new OpmOpSystemNotice();
        echo \Yii::t('app', 'Hello, {username}!', [
            'username' => 'Alexander',
        ]);exit();
        return $this->render('lists',['model'=>$model]);
    }

}
