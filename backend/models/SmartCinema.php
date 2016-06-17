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

    public static function model($className=__CLASS__){
        return new $className;
    }


    public function aGet($cinemaNo){
        return $this::find()->where(['CinemaNo' =>$cinemaNo])->asArray()->one();
    }

    /**根据影院关键字获取影院名称和影院id
     * @param $cinemaName
     * @return array
     */
    public function aGetCinemaNoByName($cinemaName){

        $ret = array();
        $list = $this::find()->select('CinemaNo,CinemaName')->where('CinemaName like "%'.$cinemaName.'%" or CinemaNo="'.$cinemaName.'"')->asArray()
            ->all();
        foreach($list as $v){
            $ret[$v['CinemaNo']] = $v['CinemaName'];
        }
        return $ret;
    }

    /**根据影院ids获取影院信息
     * @param $ids
     * @return array|\yii\db\ActiveRecord[]
     */
    public function aGetCinemaByIds($ids){
        $list = $this::find()->where(['Id'=>$ids])->asArray()
            ->all();
        return $list;
    }

}
?>