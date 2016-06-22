<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "smart_member_card".
 *
 * @property integer $card_id
 * @property string $card_no
 * @property string $account
 * @property string $card_pass
 * @property integer $pid
 * @property string $public_signal_short
 * @property integer $open_cinema_no
 * @property string $id_num
 * @property string $phone
 * @property string $invalidation_date
 * @property integer $grade_id
 * @property integer $balance
 * @property integer $card_balance
 * @property string $score
 */
class SmartMemberCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_member_card';
    }
    public static function model($className = __CLASS__)
    {
        return new $className;
    }
    public function getsmart_member_card(){
        return $this->hasOne(SmartMemberOrder::className(),['card_id'=>'card_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_no', 'card_pass', 'public_signal_short', 'invalidation_date', 'grade_id'], 'required'],
            [['pid', 'open_cinema_no', 'invalidation_date', 'grade_id', 'balance', 'card_balance'], 'integer'],
            [['card_no', 'account'], 'string', 'max' => 16],
            [['card_pass', 'public_signal_short'], 'string', 'max' => 64],
            [['id_num'], 'string', 'max' => 18],
            [['phone'], 'string', 'max' => 12],
            [['score'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card_id' => Yii::t('app', '会员ID'),
            'card_no' => Yii::t('app', '会员卡号'),
            'account' => Yii::t('app', '账号'),
            'card_pass' => Yii::t('app', 'Card Pass'),
            'pid' => Yii::t('app', '公众号id'),
            'public_signal_short' => Yii::t('app', '公众号缩写'),
            'open_cinema_no' => Yii::t('app', 'base 开卡影院编号'),
            'id_num' => Yii::t('app', '身份证号码'),
            'phone' => Yii::t('app', '电话号码'),
            'invalidation_date' => Yii::t('app', '有效时间'),
            'grade_id' => Yii::t('app', '会员卡等级编号'),
            'balance' => Yii::t('app', '卡余额, 单位:分'),
            'card_balance' => Yii::t('app', '卡余额  单位: 分'),
            'score' => Yii::t('app', '积分'),
        ];
    }
}
