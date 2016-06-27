<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
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
    protected STATIC $_STATUS_UNPAY = 0;           //未支付
    protected STATIC $_STATUS_PAY = 1;             //已支付
    protected STATIC $_STATUS_TICKET = 2;          //已出票
    protected STATIC $_STATUS_SENDCODE = 3;        //已发码
    protected STATIC $_STATUS_REFUNDING = 4;       //退款中
    protected STATIC $_STATUS_REFUNDED = 5;        //已退款
    protected STATIC $_STATUS_PAYFAILED = 11;      //支付失败
    protected STATIC $_STATUS_TICKETFAILED = 12;   //出票失败
    protected STATIC $_STATUS_SENDCODEFAILED = 13;  //发码失败
    protected STATIC $_STATUS_REFUNDREFUSED = 14;   //退款被驳回
    protected STATIC $_STATUS_REFUNDFAILED = 15;    //退款失败


    public static function getStatus()
    {
        return array(
            ''=>'',
            0 => '未支付',
            1 => '已支付',
            2 => '已出票',
            3 => '已发码',
            4 => '退款中',
            5 => '已退款',

            11 => '支付失败',
            12 => '出票失败',
            13 => '发码失败',
            14 => '退款被驳回',
            15 => '退款失败',
        );
    }
    public static function getDiscountType(){
        return array(//折扣类型,0:无折扣 1:储值会员卡 2:立减 3:代金券 4:权益卡 5:虚拟会员卡
            ''=>'',
            0 => '无折扣',
            1 => '储值会员卡',
            2 => '立减',
            3 => '代金券',
            4 => '权益卡',
            5 => '虚拟会员卡',
            6 => '',
        );
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_orders';
    }

    public static function model($className = __CLASS__)
    {
        return new $className;
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

    public function getsmart_schedule()
    {
        return $this->hasOne(SmartSchedule::className(), ['schedule_id' => 'schedule_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderid' => Yii::t('app', '订单号'),
            'pid' => Yii::t('app', '公众号编号'),
            'schedule_id' => Yii::t('app', 'Schedule ID'),
            'uid' => Yii::t('app', '用户id'),
            'cinema_no' => Yii::t('app', '影院编号'),
            'movie_no' => Yii::t('app', '影片编号'),
            'ticket_num' => Yii::t('app', '购票数量'),
            'dateline' => Yii::t('app', '购买时间'),
            'seat_info' => Yii::t('app', '座位信息'),
            'booking_system_fee' => Yii::t('app', '订座系统费用，单位分'),
            'open_system_fee' => Yii::t('app', '微影费用，单位：分'),
            'cinema_fee' => Yii::t('app', '影院费用，单位:分'),
            'total_money' => Yii::t('app', '订单总金额，单位：分'),
            'pay_money' => Yii::t('app', '支付总金额，单位：分'),
            'discount_type' => Yii::t('app', '折扣类型,0:无折扣 1:储值会员卡 2:立减 3:代金券 4:权益卡 5:虚拟会员卡 6 代金券(红包)'),
            'discount_no' => Yii::t('app', '优惠活动编号'),
            'bis_schedule_id' => Yii::t('app', '排期id'),
            'status' => Yii::t('app', '订单状态，0:未支付 1:已支付 2:已出票 3:已发码 4:退款中 5:已退款 11:支付失败 12:出票失败13:发码失败14:退款被驳回 15:退款失败'),
            'transaction_id' => Yii::t('app', '微信订单'),
            'tp_order_no' => Yii::t('app', '第三方订单号'),
            'tp_ext_order_id' => Yii::t('app', '第三方专用订单号'),
            'wx_orderid' => Yii::t('app', '微信支付订单号'),
            'ticket_code' => Yii::t('app', '取票码'),
            'qrcode_url' => Yii::t('app', '二维码地址'),
            'update_time' => Yii::t('app', '记录产生时间'),
        ];
    }
    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params)
    {
        $query = SmartOrders::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('smart_schedule');

        if (isset($params['start_date']) || isset($params['end_date'])) {
            if ($params['start_date'] && $params['end_date']) {
                $query->where("smart_orders.dateline between '" .strtotime( $params['start_date']) . "' and '" . strtotime($params['end_date']) . "'");
            } elseif ($params['start_date']) {
                $query->where("smart_orders.dateline >='" .strtotime( $params['start_date']) . "'");
            } elseif ($params['end_date']) {
                $query->where("smart_orders.dateline<='" .strtotime( $params['end_date']) . "'");
            }
        }
        $query->andwhere(['NOT IN','smart_orders.status',[0,11]]);
        $cinema_name = isset($params['cinema_name']) ? $params['cinema_name'] : '';
        !empty($params['order_id'])?$query->andWhere(['smart_orders.orderid'=>$params['order_id']]):'';
        !empty($params['discount_type'])?$query->andWhere(['smart_orders.discount_type'=>$params['discount_type']]):'';
        $order_status = (isset($params['status'])&&$params['status']!='all') ? $params['status']  : 'all';
        if($cinema_name){
            $query->andFilterWhere(['like', 'smart_schedule.cinema_name', $cinema_name]);
        }

        if ($order_status!='all') {
            $query->andWhere(['smart_orders.status' => $order_status]);
        }
        $query->OrderBy('smart_orders.dateline desc');
        return $dataProvider;
    }
    public static function formatSeat($seatInfo) {
        $return = ' ';
        $seats  = explode('|', $seatInfo);
        if ($seats) {
            foreach ($seats as $seat) {
                $tmp = explode(':', $seat);
                $return .= $tmp[1] . '排' . $tmp[2] . '座   ';
            }
        }

        return $return;
    }
}
