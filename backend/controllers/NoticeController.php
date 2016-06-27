<?php

namespace backend\controllers;

use app\models\OpmOpSystemNotice;
use app\models\OpmOpSystemNoticeTags;
use Yii;
use app\models\OpmOpSystemNoticeSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class NoticeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionList()
    {
        $searchModel = new OpmOpSystemNotice();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate(){
        $model = new OpmOpSystemNotice();
        $param = Yii::$app->request->post();
        if ($model->load($param)) {
            $model->uname=Yii::$app->user->identity->username;
            $model->uid=Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['list']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = OpmOpSystemNotice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $param = Yii::$app->request->post();
        if ($model->load($param)) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }
}
