<?php
namespace backend\models;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class SmartSingleOrder extends \yii\db\ActiveRecord {

    public static $_STATUS_PAYED    = 1;
    public static $_STATUS_UNPAYED  = 0;
    public static $_STATUS_REFUND   = 2;


    protected $_ORDER_TYPE_ENCHARGE = 1;        //充值
    protected $_ORDER_TYPE_TICKET   = 2;        //购票
    protected $_ORDER_TYPE_DESK     = 3;        //收银台

    protected $_PAY_TYPE_WX         = 1;        //微信支付
    protected $_PAY_TYPE_CARD       = 2;        //会员卡支付


    public static function model($className=__CLASS__){  
        return new $className;
    }

    public static function tableName(){
        return 'smart_single_order';  
    }


    public function aGetStatusPayCard(){
        return $this->_PAY_TYPE_CARD;
    }

    public function sOrderStatus($status){
        switch($status){
            case self::$_STATUS_UNPAYED:return '<span class="text-primary">未支付</span>';break;
            case self::$_STATUS_PAYED:return '<span class="text-danger">已支付</span>';break;
            case self::$_STATUS_REFUND:return '<span class="text-success">已退款</span>';break;
            default :return '<span class="text-primary">未支付</span>';
        }
    }



    /**获取指定日期的订单统计数据
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function aGetTongjiTotalBySum($startDate,$endDate){
        $select['n'] = "FROM_UNIXTIME(dateline,'%Y%m%d')";
        $select['pay_money'] = "sum(pay_money)/100";
        $select['num'] = "count(*)";
        $select['per'] = "sum(pay_money)/100/count(*)";

        $total = $this->find()->select($select)->where(['status'=>self::$_STATUS_PAYED])->andWhere(['between','dateline',$startDate,$endDate])
        ->groupBy('n')->asArray()->all();

        return $total;
    }


}