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

class SmartFilm extends \yii\db\ActiveRecord
{


    public static function tableName(){
        return "open_base_movie";
    }

    public static function model($className=__CLASS__){
        return new $className;
    }

    /**根据影片名称获取影片列表的信息
     * @param $filmName
     * @return array
     */
    public function aGetFilmsByName($filmeName){

        $ret = array();
        $list = $this::find()->select('MovieNameChs,MovieNo')->where(['like','MovieNameChs',$filmeName])->asArray()
            ->all();
        foreach($list as $v){
            $ret[$v['MovieNo']] = $v['MovieNameChs'];
        }
        return $ret;
    }



}
?>