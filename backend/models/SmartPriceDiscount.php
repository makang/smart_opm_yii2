<?php
/**
 * @date  2016-1-4
 * @description 打折优惠
 * @author duanlikao <duanlikao@wepiao.com>
 * @copyright 2015 WY LLC
 * @since 1.0
 */
namespace backend\models;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

class SmartPriceDiscount extends \yii\db\ActiveRecord
{
    protected STATIC $_STATUS_DELETED       = 0;        //已删除
    protected STATIC $_STATUS_UNSTART       = 1;        //未开始
    protected STATIC $_STATUS_STARTING      = 2;        //进行中
    protected STATIC $_STATUS_FINISHED      = 3;        //已结束
    protected STATIC $_STATUS_STOP          = 4;        //暂停


    public STATIC $_STATUS_SHOW = array(
        ''=>'全部',
        0=>'已删除',
        1=>'未开始',
        2=>'进行中',
        3=>'已结束',
        4=>'暂停'

    );


    public static function tableName(){
        return "smart_price_discount";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }

    /**返回卖品信息
     * @param $pdId
     * @return array|null|ActiveRecord
     */
    public function aGet($pdId)
    {
        return $this::find()->where(['pd_id'=>$pdId])->asArray()->one();
    }
    /**保存新增活动数据
     * @param $data
     * @return bool
     */
    public function saveDiscount($data){

        $data = $this->_mapDiscountField($data);
        $this->setAttributes($data,false);

        return $this->save();
    }


    /**格式化那个复杂的活动新增数据
     * @param $map
     * @return array
     */
    private function _mapDiscountField($map){

        $halls                          =       $this->_orgHall($map['Selecthalls']);
        $data = array();
        $data['name']                   =       $map['name'];
        $data['title']                  =       $map['title'];
        $data['desc']                   =       $map['desc'];
        $data['start_time']             =       strtotime($map['startDatetime']);
        $data['end_time']               =       strtotime($map['endDatetime']);
        $data['lack_stock_show']        =       $map['lack_stock_show'];
        $data['user_limit']             =       $map['userLimit'];
        $data['join_cinema_type']       =       $map['cinemaLimit'];
        $data['discount_start_date']    =       $map['ticketStartTime'];
        $data['discount_end_date']      =       $map['ticketEndTime'];
        $data['time_periods']           =       json_encode(explode(',',substr($map['useTimes'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['exclude_dates']          =       json_encode(explode(',',substr($map['myNoUseDates'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['halls']                  =       $halls;
        $data['protect_price']          =       $map['scenes_price_protection'];
        $data['report_price_type']      =       $map['report_price_type'];
        $data['set_report_price']       =       $map['set_report_price']?$map['set_report_price']*100:0;
        $data['price_protection']       =       0;
        $data['discount_price_type']    =       $map['discount_price_type'];
        $data['discount_price']         =       $map['discount_price_type']?$map['discount_price']*100:$map['discountprice']*100;
        $data['allowance_type']         =       $map['allowance_type'];
        $data['allowance_tickets']      =       !$map['allowance_type']?$map['allowance_tickets']:0;
        $data['allowance_money']        =       $map['allowance_type']?$map['allowance_money']*100:0;
        $data['one_use_max']            =       $map['ticketlimit']?$map['one_use_max']:0;
        $data['movie_type']             =       json_encode(explode(',',substr($map['version'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['join_cinemas']           =       json_encode(explode(',',substr($map['CinemaS'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['join_movies']            =       json_encode(explode(',',substr($map['films'],0,-1)),JSON_UNESCAPED_UNICODE);


        $data['price_protection']       =       0;
        $data['pid']                    =       0;
        $data['create_time']            =       time();
        return $data;
    }


    //组织一下畸形的hall存储
    private function _orgHall($halls){
        $ids = explode(',',substr($halls,0,-1));
        foreach($ids as $v){
            $infos = explode('_',$v);
            $ret[$v] = BizCinemaHall::model()->aGetIdByBizCinemaNos($infos[0],$infos[1]);
        }
        return  json_encode($ret,JSON_UNESCAPED_UNICODE);
    }


}
?>