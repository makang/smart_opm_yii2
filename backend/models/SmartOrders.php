<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smart_orders".
 *
 * @property string $orderid
 * @property integer $pid
 * @property integer $schedule_id
 * @property integer $uid
 * @property string $cinema_no
 * @property string $movie_no
 * @property integer $ticket_num
 * @property integer $dateline
 * @property string $seat_info
 * @property integer $booking_system_fee
 * @property integer $open_system_fee
 * @property integer $cinema_fee
 * @property integer $total_money
 * @property integer $pay_money
 * @property integer $discount_type
 * @property string $discount_no
 * @property integer $bis_schedule_id
 * @property integer $status
 * @property string $transaction_id
 * @property string $tp_order_no
 * @property string $tp_ext_order_id
 * @property string $wx_orderid
 * @property string $ticket_code
 * @property string $qrcode_url
 * @property string $update_time
 */
class SmartOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid', 'schedule_id'], 'required'],
            [['pid', 'schedule_id', 'uid', 'ticket_num', 'dateline', 'booking_system_fee', 'open_system_fee', 'cinema_fee', 'total_money', 'pay_money', 'discount_type', 'bis_schedule_id', 'status'], 'integer'],
            [['update_time'], 'safe'],
            [['orderid'], 'string', 'max' => 20],
            [['cinema_no', 'movie_no'], 'string', 'max' => 7],
            [['seat_info'], 'string', 'max' => 255],
            [['discount_no'], 'string', 'max' => 32],
            [['transaction_id', 'tp_order_no', 'tp_ext_order_id', 'ticket_code'], 'string', 'max' => 64],
            [['wx_orderid'], 'string', 'max' => 28],
            [['qrcode_url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderid' => Yii::t('app\', '订单号'),
            'pid' => Yii::t('app\', '公众号编号'),
            'schedule_id' => Yii::t('app\', 'Schedule ID'),
            'uid' => Yii::t('app\', '用户id'),
            'cinema_no' => Yii::t('app\', '影院编号'),
            'movie_no' => Yii::t('app\', '影片编号'),
            'ticket_num' => Yii::t('app\', '购票数量'),
            'dateline' => Yii::t('app\', '购买时间'),
            'seat_info' => Yii::t('app\', '座位信息'),
            'booking_system_fee' => Yii::t('app\', '订座系统费用，单位分'),
            'open_system_fee' => Yii::t('app\', '微影费用，单位：分'),
            'cinema_fee' => Yii::t('app\', '影院费用，单位:分'),
            'total_money' => Yii::t('app\', '订单总金额，单位：分'),
            'pay_money' => Yii::t('app\', '支付总金额，单位：分'),
            'discount_type' => Yii::t('app\', '折扣类型,0:无折扣 1:储值会员卡 2:立减 3:代金券 4:权益卡 5:虚拟会员卡 6 代金券(红包)'),
            'discount_no' => Yii::t('app\', '优惠活动编号'),
            'bis_schedule_id' => Yii::t('app\', '排期id'),
            'status' => Yii::t('app\', '订单状态，0:未支付 1:已支付 2:已出票 3:已发码 4:退款中 5:已退款 11:支付失败 12:出票失败13:发码失败14:退款被驳回 15:退款失败'),
            'transaction_id' => Yii::t('app\', '微信订单'),
            'tp_order_no' => Yii::t('app\', '第三方订单号'),
            'tp_ext_order_id' => Yii::t('app\', '第三方专用订单号'),
            'wx_orderid' => Yii::t('app\', '微信支付订单号'),
            'ticket_code' => Yii::t('app\', '取票码'),
            'qrcode_url' => Yii::t('app\', '二维码地址'),
            'update_time' => Yii::t('app\', '记录产生时间'),
        ];
    }
}
