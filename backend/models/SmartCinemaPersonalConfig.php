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

class SmartCinemaPersonalConfig extends \yii\db\ActiveRecord
{
    //售票系统
    public static $_BOOKINGSYSTEM_DESC = array(
        'DingXin'           =>  '鼎新售票系统',
        'Flamingo'          =>  '火烈鸟售票系统',
        'HuoFengHuang'      =>  '火凤凰售票系统',
        'VISTA'             =>  'VISTA售票系统',
        'ChenXing'          =>  '辰星售票系统',
        'ManTianXing'       =>  '满天星售票系统',
        'OneNineZeroFive'   =>  '1905售票系统',
    );
    //是否开启卖品
    public static $_SUITSTATUS_DESC = array(
        0           =>  '否',
        1           =>  '是'
    );
    //卖品码加密方式
    public static $_CODEENC_DESC = array(
        'qrcode'        =>  '二维码',
        'codebar'       =>  'codebar',
        'code11'        =>  'code11',
        'code39'        =>  'code39',
        'code39 extend' =>  'code39 extend',
        'code 128'      =>  'code 128',
        'EAN-8'         =>  'EAN-8',
        'EAN-13'        =>  'EAN-13',

    );
    public static function tableName(){
        return "smart_cinema_personal_config";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }



    public function bSave($list,$cinemaNos){
        echo "<pre/>";
        foreach($cinemaNos as $v){
            $publicSignal = SmartCinema::model()->aGetPsByCinemaNo($v);
            if(!$publicSignal)continue;

            $data = $this::findone(['pid'=>$publicSignal['pid'],'cinema_no'=>$v]);
            if(!$data){
                $data = new SmartCinemaPersonalConfig();
            }

            $data->pid                  = $publicSignal['pid'];
            $data->cinema_no            = $v;
            $data->ticket_system        = $list['ticket_system'];
            $data->booking_system_fee   = $list['booking_system_fee']*100;
            $data->open_system_fee      = $list['open_system_fee']*100;
            $data->cinema_fee           = $list['cinema_fee']*100;
            $data->suit_code_enc        = $list['suit_code_enc'];
            $data->ticket_code_enc      = $list['ticket_code_enc'];
            $data->has_suit             = $list['has_suit'];


            $data->save();
        }
        return true;

    }





}
?>