<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
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
    public static function model($className = __CLASS__)
    {
        return new $className;
    }
    public function getsmart_orders()
    {
        return $this->hasOne(SmartOrders::className(), ['orderid' => 'order_id']);
    }
    public function getsmart_member_card(){
        return $this->hasOne(SmartMemberCard::className(),['card_id'=>'card_id']);
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


    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params)
    {
        $query = SmartMemberOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('smart_orders.smart_schedule');

        if (isset($params['start_date']) || isset($params['end_date'])) {
            if ($params['start_date'] && $params['end_date']) {
                $query->where("smart_member_order.pay_time between '" .strtotime( $params['start_date']) . "' and '" . strtotime($params['end_date']) . "'");
            } elseif ($params['start_date']) {
                $query->where("smart_member_order.pay_time>='" .strtotime( $params['start_date']) . "'");
            } elseif ($params['end_date']) {
                $query->where("smart_member_order.pay_time<='" .strtotime( $params['end_date']) . "'");
            }
        }
        $query->andwhere(['smart_price_discount_order.status' => 1]);
        $cinema_name = isset($params['cinema_name']) ? $params['cinema_name'] : '';
        $order_status = (isset($params['status'])&&$params['status']!='all') ? $params['status']  : '';
        if($cinema_name){
            $query->andFilterWhere(['like', 'smart_schedule.cinema_name', $cinema_name]);
        }
        if ($order_status) {
            $query->andWhere(['smart_orders.status' => $order_status]);
        }

        $query->OrderBy('smart_member_order.pay_time desc')->asArray()->all();
        return $dataProvider;
    }
}
