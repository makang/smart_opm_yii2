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

class SmartPublicSignalCinema extends \yii\db\ActiveRecord
{
    public static $_STATUS_CANCEL  =  9;            //取消绑定
    public static $_STATUS_BINDED  =  0;            //取消绑定

    public static function tableName(){
        return "open_base_publicsignal_cinema";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }


    /**根据pid获取pid下面的影院信息
     * @param $pid
     * @return mixed
     */
    public function aGetCinemasByPid($pid){
        $res        = $this::find()->where(['PublicSignalId'=>$pid,'Status'=>self::$_STATUS_BINDED])->asArray()->all();
        $cinemaIds  = array_map(function ($record) {return $record['CinemaId'];}, $res);
        $cinemas    = SmartCinema::model()->aGetCinemaByIds($cinemaIds);
        return $cinemas;
    }

     public static function getAllCinemaIds(){
         $cinemaIds=[];
         $ids=self::find()->select('CinemaId')->where(['Status'=>self::$_STATUS_BINDED])->groupBy('CinemaId')->asArray()->all();
         foreach ($ids as $value){
             $cinemaIds[]=$value['CinemaId'];
         }
         return $cinemaIds;
     }


    /**取消绑定影院（smart库和openbase库都需要重新变更）
     * @param $pid
     * @param $cinemaNo
     * @return bool
     */
    public function bUpdateCancel($pid,$cinemaNo){
        $publisSignal = SmartPublicSignal::model()->oGet($pid);
        $cinema         =   SmartCinema::model()->aGet($cinemaNo);
        $smart =  $this::find()->where(['PublicSignalId'=>$publisSignal->Id,'CinemaId'=>$cinema['Id']])->one(Yii::$app->db);
        $smart->Status = self::$_STATUS_CANCEL;
        $resSmart = $smart->save();

        $openS =  OpenBasePublicsignalCinema::find()->where(['PublicSignalId'=>$publisSignal->Id,'CinemaId'=>$cinema['Id']])->one(Yii::$app->db_opensystem);
        $openS->Status = self::$_STATUS_CANCEL;
        $resOpenS = $openS->save();
        return $resSmart && $resOpenS?true:false;


    }

    /**绑定影院（smart库和openbase库都需要重新变更）
     * @param $pid
     * @param $cinemaNo
     * @return bool
     */
    public function bUpdateBind($pid,$cinemaNo){


        $publisSignal = SmartPublicSignal::model()->oGet($pid);
        $cinema         =   SmartCinema::model()->aGet($cinemaNo);

        $mongoCinemaWhere = array(
            '_id' => $cinema['Id']
        );
        $mongoCinema = 'Bson_Base_Cinema';
       // $cinema_info = MongoUtil::find($mongoCinema, $mongoCinemaWhere);
       // $ID = new MongoId();
       // $id = $ID->{'$id'};


        $smart =  $this::find()->where(['PublicSignalId'=>$publisSignal->Id,'CinemaId'=>$cinema['Id']])->one(Yii::$app->db);
        $smart->Status = self::$_STATUS_BINDED;
        $smart->EditTime = date('Y-m-d H:i:s');

        $resSmart = $smart->save();

        $openS =  OpenBasePublicsignalCinema::find()->where(['PublicSignalId'=>$publisSignal->Id,'CinemaId'=>$cinema['Id']])->one(Yii::$app->db_opensystem);
        $openS->Status = self::$_STATUS_BINDED;
        $openS->EditTime = date('Y-m-d H:i:s');
        $resOpenS = $openS->save();

        return $resSmart && $resOpenS?true:false;


    }







}
?>