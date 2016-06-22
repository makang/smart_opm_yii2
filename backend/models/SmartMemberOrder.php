<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smart_member_order".
 *
 * @property integer $id
 * @property string $open_id
 * @property string $card_id
 * @property string $public_signal_short
 * @property integer $tiket_num
 * @property string $pay_time
 * @property integer $balance
 * @property string $cinema_no
 * @property integer $cost_cinema_no
 * @property string $mobile_phone
 * @property string $film_no
 * @property string $movie_priceing_id
 * @property string $old_price
 * @property string $discount
 * @property string $order_id
 * @property integer $price
 * @property string $price_list
 * @property string $fee_list
 * @property string $booking_id
 * @property string $seats
 * @property integer $cumulation_marking
 * @property string $edit_time
 */
class SmartMemberOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_member_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id', 'card_id', 'public_signal_short', 'tiket_num', 'balance', 'cinema_no'], 'required'],
            [['tiket_num', 'balance', 'cost_cinema_no', 'price', 'cumulation_marking'], 'integer'],
            [['pay_time', 'edit_time'], 'safe'],
            [['old_price', 'discount'], 'number'],
            [['open_id', 'public_signal_short', 'film_no'], 'string', 'max' => 64],
            [['card_id', 'order_id', 'price_list', 'fee_list', 'booking_id'], 'string', 'max' => 24],
            [['cinema_no'], 'string', 'max' => 11],
            [['mobile_phone'], 'string', 'max' => 12],
            [['movie_priceing_id'], 'string', 'max' => 32],
            [['seats'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '交易记录ID'),
            'open_id' => Yii::t('app', '用户ID'),
            'card_id' => Yii::t('app', '会员卡编号'),
            'public_signal_short' => Yii::t('app', 'Public Signal Short'),
            'tiket_num' => Yii::t('app', '总购票票数'),
            'pay_time' => Yii::t('app', '支付时间'),
            'balance' => Yii::t('app', '会员卡余额'),
            'cinema_no' => Yii::t('app', '卡所属影院编号'),
            'cost_cinema_no' => Yii::t('app', 'base 消费影院编号'),
            'mobile_phone' => Yii::t('app', '手机号码'),
            'film_no' => Yii::t('app', '影片号'),
            'movie_priceing_id' => Yii::t('app', '排期号'),
            'old_price' => Yii::t('app', '支付前余额'),
            'discount' => Yii::t('app', '折扣'),
            'order_id' => Yii::t('app', '订单号'),
            'price' => Yii::t('app', '消费金额'),
            'price_list' => Yii::t('app', '影票价格列表'),
            'fee_list' => Yii::t('app', '影票手续费列表'),
            'booking_id' => Yii::t('app', '订座系统订单号'),
            'seats' => Yii::t('app', '座位列表'),
            'cumulation_marking' => Yii::t('app', '会员卡累计积分'),
            'edit_time' => Yii::t('app', '最后修改时间'),
        ];
    }
}
