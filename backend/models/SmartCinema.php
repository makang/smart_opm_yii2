<?php
/**
 * @date  2016-1-4
 * @description 打折优惠
 * @author duanlikao <duanlikao@wepiao.com>
 * @copyright 2015 WY LLC
 * @since 1.0
 */
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class SmartCinema extends \yii\db\ActiveRecord
{


    public static function tableName(){
        return "open_base_cinema";
    }



    public function aGetCinemaNoByName($cinemaName){

        $ret = array();
        $list = $this::find()->select('CinemaNo')->where('CinemaName like "%'.$cinemaName.'%" or CinemaNo='.$cinemaName)->asArray()
            ->all();
        foreach($list as $v){
            $ret[] = $v['CinemaNo'];
        }
        return $ret;
    }







    /**对象转化成数组
     * @param $criteria
     * @return mixed|static[]
     */
    private function _toArray($criteria){
        $ret = $this->findAll($criteria);
        $ret = json_decode(CJSON::encode($ret),true);
        if($criteria->select !='*'){
            $field = explode(',',$criteria->select);
            $field = array_flip($field);
            foreach($ret as $k => $v){
                $ret[$k] = array_intersect_key($v,$field);
            }
        }
        return $ret;
    }
}
?>