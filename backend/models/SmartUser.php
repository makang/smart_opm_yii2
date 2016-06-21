<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smart_user".
 *
 * @property integer $uid
 * @property string $openid
 * @property integer $pid
 * @property string $nickname
 * @property integer $sex
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $phone
 * @property string $avatar
 * @property integer $create_time
 */
class SmartUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sex', 'create_time'], 'integer'],
            [['openid', 'nickname', 'country', 'city'], 'string', 'max' => 64],
            [['province'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 12],
            [['avatar'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('app\', '用户id'),
            'openid' => Yii::t('app\', 'openid'),
            'pid' => Yii::t('app\', '公众号id'),
            'nickname' => Yii::t('app\', '用户昵称'),
            'sex' => Yii::t('app\', '性别  0:保密1：男2：女'),
            'country' => Yii::t('app\', '所在国'),
            'province' => Yii::t('app\', '所在省'),
            'city' => Yii::t('app\', '所在市'),
            'phone' => Yii::t('app\', '手机号'),
            'avatar' => Yii::t('app\', '头像地址'),
            'create_time' => Yii::t('app\', '创建时间'),
        ];
    }
}
