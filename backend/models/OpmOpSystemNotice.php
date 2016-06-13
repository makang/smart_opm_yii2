<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opm_op_system_notice".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $status
 * @property string $creatTime
 * @property integer $uid
 * @property string $uname
 * @property string $upTime
 * @property integer $upuid
 * @property string $upuname
 */
class OpmOpSystemNotice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opm_op_system_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string'],
            [['status', 'uid', 'upuid'], 'integer'],
            [['creatTime', 'upTime'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['uname', 'upuname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '公告标题'),
            'url' => Yii::t('app', '公告URL'),
            'status' => Yii::t('app', ' 0:未发布  1: 已发布  2 删除 3 已结束'),
            'creatTime' => Yii::t('app', 'Creat Time'),
            'uid' => Yii::t('app', '创建人ID'),
            'uname' => Yii::t('app', '创建人'),
            'upTime' => Yii::t('app', 'Up Time'),
            'upuid' => Yii::t('app', '修改人ID'),
            'upuname' => Yii::t('app', '修改人'),
        ];
    }

    /**
     * @inheritdoc
     * @return OpmOpSystemNoticeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpmOpSystemNoticeQuery(get_called_class());
    }
}
