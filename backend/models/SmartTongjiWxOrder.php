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

class SmartTongjiWxOrder extends \yii\db\ActiveRecord
{

    protected STATIC $_TYPE_PAYED      = 1;
    protected STATIC $_TYPE_REFUND     = 2;
    protected STATIC $_TYPE_UNPAYED    = 3;
    protected STATIC $_TYPE_ENCHARGE   = 4;


    public static function tableName(){
        return "smart_tongji_weixin_order";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    public function oSearch($params){
        $query = SmartTongjiWxOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        !empty($params['pid'])?$query->andFilterWhere(['pid'=>$params['pid']]):'';
        if(!empty($params['cinema_no'])){
            $cinema = new SmartCinema();
            $ids = $cinema->aGetCinemaNoByName($params['cinema_no']);
            $ids = array_keys($ids);
            $query->andFilterWhere(['cinema_no'=>$ids]);
        }
        $params['date'] = !empty($params['start_date'])?$params['start_date']:date('Y-m');


        $date = $this->aGetMonthTimestamp($params['date']);
        $query->andFilterWhere(['between','create_time',$date[0],$date[1]]);

        $query->select($this->aGetMonthField());
        $query->groupBy('cinema_no');
        return $dataProvider;
    }

    public function oSearchDetail($params){
        $query = SmartSingleOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['cinema_no'=>$params['cinema_no']]);
        if(!empty($params['date']) && empty($params['start_date'])){
            $startDate = strtotime(date('Ym',strtotime($params['date'])).'01');
            $endDate   = strtotime('+1 month',$startDate)-1;

        }elseif($params['start_date'] && $params['end_date']){
            $startDate = strtotime($params['start_date']);
            $endDate   = strtotime($params['end_date']);
            $endDate   = $endDate>strtotime('+1 month',$startDate)?strtotime('+1 month',$startDate)-1:$endDate;
        }

        $query->andFilterWhere(['between','dateline',$startDate,$endDate]);
        $query->andFilterWhere(['status'=>[1,2]]);
        $wxOrder = $this->aGetWxData($params['cinema_no'],$startDate,$endDate);
        $opOrders = array();
        foreach($dataProvider->getModels() as $v){
            $modelArray = $v->toArray();
            $opOrders[] = $modelArray;
        }
        $opOrders = $this->aMergeOrderWithWx($opOrders,$wxOrder);
        $dataProvider->setModels($opOrders);

        return $dataProvider;
    }


    /**根据日期给出该日期月份的起止时间戳
     * @param $date
     * @return array
     */
    public function aGetMonthTimestamp($date){
        $starDate = substr($date,0,7);

        $starDate = $starDate?strtotime($starDate.'-01'):strtotime(date('Y-m').'-01');
        $endDate = strtotime('+1 month',$starDate)-1;
        $ret = array($starDate,$endDate);
        return $ret;
    }
    /**获取指定月份的微信原始账单数据
     * @param $cinemaNo
     * @param $date
     */
    public function aGetRawWxData($cinemaNo,$date){
        $date = $this->aGetMonthTimestamp($date);
        $res = $this->find()->where('cinema_no='.$cinemaNo.' and create_time between '.$date[0].' and '.$date[1])->asArray()->all();
        $wxData = array();
        foreach($res as $v){
            $wxData = array_merge(json_decode($v['wx_data'],true),$wxData);
        }
        return $wxData;
    }


    /**生成指定日期的excel信息
     * @param $list
     * @param $column
     * @return string
     */


    public function sGenerateBlank($list,$column){
        $str = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns="http://www.w3.org/TR/REC-html40">
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html>
     <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
         <style id="Classeur1_16681_Styles"></style>
     </head>
     <body>
         <div id="Classeur1_16681" align=center x:publishsource="Excel">
             <table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse"><tr>';
        foreach($column as $v){

            $str .= '<td>'.$v.'</td>';
        }
        $str .= '</tr>';
        foreach($list as $v){
            $str .= '<tr><td>'.implode('</td><td>',$v).'</td></tr>';
        }


        $str .= '    </table>
                 </div>
             </body>
         </html> ';

        return $str;

    }

    /**某个影院某个时间段的微信支付订单信息
     * @param $cinemaNo
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function aGetWxData($cinemaNo,$startDate,$endDate){
        $wxOrder = array();
        $ret = $this->find()->where(
            'cinema_no='.$cinemaNo.' and create_time between '.$startDate.' and '.$endDate
            )->asArray()->all();

        foreach($ret as $v){
            $ret =  json_decode($v['wx_data'],true);
            foreach($ret as $wx){
                $wxOrder[$wx[6]][$wx[9]]    =   $wx;
            }
        }
        return $wxOrder;
    }

    /**合并微信订单
     * @param $opOrder
     * @param $wxOrder
     */
    private function aMergeOrderWithWx($opOrder,$wxOrder){
        foreach($opOrder as &$v){
            if(empty($wxOrder[$v['orderid'].'-'.$v['pay_money']]))continue;
            $key = $wxOrder[$v['orderid'].'-'.$v['pay_money']];

            $v['wxAccount']         = $key['SUCCESS'][3];
            $v['wxOrder']           = $key['SUCCESS'][5];
            $v['wxOrderMid']        = $key['SUCCESS'][6];
            $v['wxMoney']           = $key['SUCCESS'][12];
            $v['wxFee']             = $key['SUCCESS'][22];
            $v['wxName']            = $key['SUCCESS'][20];
            $v['wxRefundMoney']     = !empty($key['REFUND'][16])?$key['REFUND'][16]:'';
            $v['wxRefundFee']       = !empty($key['REFUND'][22])?$key['REFUND'][22]:'';
            if($v['pay_type'] == 1 && $v['order_type']==1){
                $v['wxName'] = '会员卡充值';
            }elseif($v['pay_type'] == 2 && $v['order_type']==2){
                $v['wxName'] = '会员卡购票';
            }
        }
        return $opOrder;
    }

    private function aGetMonthField(){
        $field = array(
            'date',
            'pid',
            'cinema_no',
            'sum(order_num) as order_num',
            'sum(order_money) as order_money',
            'sum(order_fee) as order_fee',

            'sum(ticket_num) as ticket_num',
            'sum(ticket_money) as ticket_money',
            'sum(ticket_fee) as ticket_fee',

            'sum(suit_num) as suit_num',
            'sum(suit_money) as suit_money',
            'sum(suit_fee) as suit_fee',


            'sum(refund_num) as refund_num',
            'sum(refund_money) as refund_money',
            'sum(refund_fee) as refund_fee',

            'sum(enc_num) as enc_num',
            'sum(enc_money) as enc_money',
            'sum(enc_fee) as enc_fee',

            'sum(mem_num) as mem_num',
            'sum(mem_money) as mem_money',
            'sum(mem_fee) as mem_fee'
        );
    }
}
?>