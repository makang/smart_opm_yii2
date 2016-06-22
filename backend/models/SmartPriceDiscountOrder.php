<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "smart_price_discount_order".
 *
 * @property integer $id
 * @property integer $pd_id
 * @property integer $uid
 * @property integer $cinema_no
 * @property integer $movie_no
 * @property integer $ticket_num
 * @property integer $report_price
 * @property integer $fees
 * @property integer $discount_money
 * @property string $orderid
 * @property integer $status
 * @property integer $create_time
 * @property string $update_time
 */
class SmartPriceDiscountOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_price_discount_order';
    }
    public static function model($className=__CLASS__)
    {
        return new $className;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pd_id', 'uid', 'cinema_no', 'movie_no', 'ticket_num', 'report_price', 'fees', 'discount_money', 'status', 'create_time'], 'integer'],
            [['update_time'], 'safe'],
            [['orderid'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pd_id' => Yii::t('app', 'Pd ID'),
            'uid' => Yii::t('app', 'user id'),
            'cinema_no' => Yii::t('app', '影院basecinemano'),
            'movie_no' => Yii::t('app', 'Movie No'),
            'ticket_num' => Yii::t('app', '使用优惠购买票数'),
            'report_price' => Yii::t('app', '上报票房价格 (乘以票数) (单位分)'),
            'fees' => Yii::t('app', '各费用总和 (乘以票数) (单位分)'),
            'discount_money' => Yii::t('app', '优惠折扣钱数  (乘以票数) (单位分)'),
            'orderid' => Yii::t('app', 'Orderid'),
            'status' => Yii::t('app', '状态 0 未支付 1 支付成功 -1 支付失败'),
            'create_time' => Yii::t('app', '创建时间 时间戳'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
    /*
     * 获取已使用票数
     */
    public function  iGetConsmeTicket($pd_id){
        $ret =  $this::find()->select('sum(ticket_num) ticket_num')->where('pd_id='.$pd_id.' and `status`=1')->asArray()->one();
        return $ret['ticket_num']+0;

    }
    /*
     * 获取已使用掉的活动金额
     */
    public function iGetSendMoney($pd_id){
        $ret = $this->find()->select('sum(discount_money) as send_money ')->where('pd_id='.$pd_id)->asArray()->one();
        return $ret['send_money']+0;
    }
}
