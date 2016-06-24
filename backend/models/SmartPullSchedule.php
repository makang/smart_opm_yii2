<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smart_pull_schedule".
 *
 * @property integer $id
 * @property string $cinema_no
 * @property string $status
 * @property string $complete_time
 * @property string $create_time
 * @property string $administer
 */
class SmartPullSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_pull_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cinema_no'], 'required'],
            [['complete_time', 'create_time'], 'safe'],
            [['cinema_no'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 2],
            [['administer'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'cinema_no' => Yii::t('app', '影院编号'),
            'status' => Yii::t('app', '0:未拉取1：已拉取'),
            'complete_time' => Yii::t('app', '完成时间'),
            'create_time' => Yii::t('app', '创建时间'),
            'administer' => Yii::t('app', '执行人'),
        ];
    }
    public static function insertPullSchedule($param){

        $pull=new SmartPullSchedule();
        $pull->cinema_no=$param['cinema_no'];
        $pull->status='0';
        $pull->complete_time=date('Y-m-d H:i:s',time());
        $pull->create_time=date('Y-m-d H:i:s',time());
        $pull->administer='';

        return $pull->insert();

    }
}
