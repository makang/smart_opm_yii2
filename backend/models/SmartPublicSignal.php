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

class SmartPublicSignal extends \yii\db\ActiveRecord
{
    public static $_STATUS_COORPING = 1;         //合作中
    public static $_STATUS_NOCOOR   = 0;         //合作停止
    //公众号类型
    public static $_THEME_DESC = array(
        '1'  =>  '影院',
        '2'  =>  '院线',
        '3'  =>  '影片',
        '4'  =>  '影视服务公司',

    );
    //合作状态
    public static $_COOR_DESC = array(
        '1'  =>  '合作中',
        '2'  =>  '已结束',

    );
    //公众号类型
    public static $_TYPE_DESC = array(
        '1' =>  '服务号',
        '2' =>  '订阅号',
    );
    //是否受理商
    public static $_ACCEPT_DESC = array(
        0   =>  '否',
        1   =>  '是'
    );
    //是否子账号
    public static $_CACCOUNT_DESC   = array(
        0   =>  '否',
        1   =>  '是'
    );



    public static function tableName(){
        return "open_base_publicsignal";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    public function oGet($pid){
        return $this::findOne(['pid'=>$pid]);
    }

    //获取合作状态
    public function sGetCoorStatus($status){
        if(!array_key_exists($status,self::$_COOR_DESC)){
            return '已结束';
        }else{
            return self::$_COOR_DESC[$status];
        }
    }

    /**根据pid停止合作
     * @param $pid
     * @return bool
     */
    public function bUpdateStopCoor($pid){
        $res = $this::find()->where(['pid'=>$pid])->one();
        $res->CooperationStatus = self::$_STATUS_NOCOOR;
        return $res->save();

    }
    //获取合作主题文字
    public function sGetThemeDesc($id){
        return self::$_THEME_DESC[$id];
    }


}
?>