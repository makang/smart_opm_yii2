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

class SmartPriceCutExtends extends \yii\db\ActiveRecord
{





    public static function tableName(){
        return "smart_price_cut_extends";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    public function iGetSendMoney($pcId){
        $ret = $this->find()->where('pc_id='.$pcId)->asArray()->one();
        return $ret['send_money']+0;
    }

}
?>