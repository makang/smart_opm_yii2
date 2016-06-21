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

class SmartChildAccount extends \yii\db\ActiveRecord
{
    public static $_STATUS_COORPING = 1;         //合作中
    public static $_STATUS_NOCOOR   = 0;         //合作停止


    public static function tableName(){
        return "smart_child_account";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    public function oGet($pid){
        return $this::findOne(['cinema_no'=>$pid]);
    }

    /**保存修改的子账号信息
     * @param $cinemaNo
     * @param $data
     * @return bool
     */
    public function bSave($cinemaNo,$data){
        $columns = $this::getTableSchema()->getColumnNames();
        foreach($data as $k=>$v){
            if(!in_array($k,$columns)){unset($data[$k]);continue;};
        }
        $t = $this::findOne(['cinema_no'=>$cinemaNo]);
        $t->setAttributes($data,false);
        return $t->save();
    }

}
?>