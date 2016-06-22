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

class SmartPriceCutLog extends \yii\db\ActiveRecord
{




    public static function tableName(){
        return "smart_price_cut_log";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    /**获取活动已经使用的票数和金额
     * @param $pc_id
     */
    public function iGetConsmeTicket($pcId){
       $ret =  $this::find()->select('sum(ticket_num) ticket_num')->where('pc_id='.$pcId.' and `status`=1')->asArray()->one();
       return $ret['ticket_num']+0;
    }
    

}
?>