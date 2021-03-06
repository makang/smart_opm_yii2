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
use yii\data\ActiveDataProvider;

class SmartCinema extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db_opensystem;
    }

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
    public function oSearch($params)
    {
        $query = SmartCinema::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->select('CinemaNo,CinemaName,TicketSaleSystem');
        if (isset($params['cinema_no']))
            $query->where('CinemaName like "%' . $params['cinema_no'] . '%" or CinemaNo="' . $params['cinema_no'] . '"');
        $cinemaIds=SmartPublicSignalCinema::getAllCinemaIds();
        $query->andFilterWhere(['Id'=>$cinemaIds]);
        $query->groupBy('CinemaNo');
        return $dataProvider;
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
    /*
     * 根据影院编号获取影院名称
     */
    public static function getCinemaNameByCinemaNo($cinema_no){
        $cinema_name='';
        if($cinema_no) {
            $cinemaInfo = SmartCinema::findOne(['CinemaNo' => $cinema_no]);
            if($cinemaInfo){
                $cinema_name=$cinemaInfo['CinemaName'];
            }
        }

        return $cinema_name;
    }
    /**根据影院no获取公众号信息
     * @param $cinemaNo
     * @return array
     */
    public function aGetPsByCinemaNo($cinemaNo){
        $ps = array();
        $map = $this::findOne(['CinemaNo'=>$cinemaNo]);
        $pm  = SmartPublicSignalCinema::findOne(['CinemaId'=>$map->Id]);
        if($pm){
            $ps  = SmartPublicSignal::findOne(['Id'=>$pm->PublicSignalId]);

        }

        return $ps;
    }

}
?>