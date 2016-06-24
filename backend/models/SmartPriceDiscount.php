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
use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use backend\models\SmartPriceDiscountOrder;

class SmartPriceDiscount extends \yii\db\ActiveRecord
{
    protected STATIC $_STATUS_UNSTART       = 0;        //未开始
    protected STATIC $_STATUS_STARTING      = 1;        //生效中
    protected STATIC $_STATUS_CLOSED        = 3;        //已关闭
    protected STATIC $_STATUS_FINISHED      = 4;        //已结束
    protected STATIC $_STATUS_STOCKOUT      = 5;        //库存不足


    public STATIC $_STATUS_SHOW = array(
        ''=>'全部',
        0=>'未开始',
        1=>'生效中',
        3=>'已结束',
        4=>'已结束',
        5=>'库存不足'
    );


    public static function tableName(){
        return "smart_price_discount";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }

    /**返回卖品信息
     * @param $pdId
     * @return array|null|ActiveRecord
     */
    public function aGet($pdId)
    {
        return $this::find()->where(['pd_id'=>$pdId])->asArray()->one();
    }
    /**保存新增活动数据
     * @param $data
     * @return bool
     */
    public function saveDiscount($data){

        $data = $this->_mapDiscountField($data);
        $this->setAttributes($data,false);

        return $this->save();
    }
    public function updateDiscount($data){
       // var_dump($data);exit();
        $model=SmartPriceDiscount::findOne($data['pd_id']);

        $data = $this->_mapDiscountField($data);
        $model->setAttributes($data,false);

        return $model->update();
    }

    /**格式化那个复杂的活动新增数据
     * @param $map
     * @return array
     */
    private function _mapDiscountField($map){

        $halls                          =       $this->_orgHall($map['Selecthalls']);
        $data = array();
        $data['name']                   =       $map['name'];
        $data['title']                  =       $map['title'];
        $data['desc']                   =       $map['desc'];
        $data['start_time']             =       strtotime($map['startDatetime']);
        $data['end_time']               =       strtotime($map['endDatetime']);
        $data['lack_stock_show']        =       $map['lack_stock_show'];
        $data['user_limit']             =       $map['userLimit'];
        $data['join_cinema_type']       =       $map['cinemaLimit'];
        $data['discount_start_date']    =       $map['ticketStartTime'];
        $data['discount_end_date']      =       $map['ticketEndTime'];
        $data['time_periods']           =       json_encode(explode(',',substr($map['useTimes'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['exclude_dates']          =       json_encode(explode(',',substr($map['myNoUseDates'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['halls']                  =       $halls;
        $data['protect_price']          =       $map['scenes_price_protection'];
        $data['report_price_type']      =       $map['report_price_type'];
        $data['set_report_price']       =       $map['set_report_price']?$map['set_report_price']*100:0;
        $data['price_protection']       =       0;
        $data['discount_price_type']    =       $map['discount_price_type'];
        $data['discount_price']         =       $map['discount_price_type']?$map['discount_price']*100:$map['discountprice']*100;
        $data['allowance_type']         =       $map['allowance_type'];
        $data['allowance_tickets']      =       !$map['allowance_type']?$map['allowance_tickets']:0;
        $data['allowance_money']        =       $map['allowance_type']?$map['allowance_money']*100:0;
        $data['one_use_max']            =       $map['ticketlimit']?$map['one_use_max']:0;
        $data['movie_type']             =       json_encode(explode(',',substr($map['version'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['join_cinemas']           =       json_encode(explode(',',substr($map['CinemaS'],0,-1)),JSON_UNESCAPED_UNICODE);
        $data['join_movies']            =       json_encode(explode(',',substr($map['films'],0,-1)),JSON_UNESCAPED_UNICODE);


        $data['price_protection']       =       0;
        $data['pid']                    =       0;
        $data['create_time']            =       time();
        return $data;
    }


    //组织一下畸形的hall存储
    private function _orgHall($halls){
        $ids = explode(',',substr($halls,0,-1));
        foreach($ids as $v){
            $infos = explode('_',$v);
            $ret[$v] = BizCinemaHall::model()->aGetIdByBizCinemaNos($infos[0],$infos[1]);
        }
        return  json_encode($ret,JSON_UNESCAPED_UNICODE);
    }
    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params){
        $query = SmartPriceDiscount::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        !empty($params['pd_id'])?$query->andFilterWhere(['pd_id'=>$params['pd_id']]):'';
        !empty($params['name'])?$query->andFilterWhere(['like','name',$params['name']]):'';
        isset($params['status']) && $params['status']!=='' ?$query->andFilterWhere(['status'=>$params['status']]):'';
        $query->addOrderBy('pd_id desc');

        $opOrders = array();
        foreach($dataProvider->getModels() as $v){
            $modelArray = $v->toArray();
            $ticketNum   =   SmartPriceDiscountOrder::model()->iGetConsmeTicket($v->pd_id);
            $modelArray['ticket_num'] = $ticketNum;
            $sendMoney   =   SmartPriceDiscountOrder::model()->iGetSendMoney($v->pd_id);
            $modelArray['send_money'] = $sendMoney;

            $opOrders[] = $modelArray;
        }

        $dataProvider->setModels($opOrders);
        return $dataProvider;
    }
    /**返回活动的状态
     * @param $status
     */
    public function sGetStatus($status){
        switch ($status) {
            case self::$_STATUS_UNSTART:
                return '<span class="label label-sm label-info arrowed arrowed-righ">未开始</span>';
                break;
            case self::$_STATUS_STARTING:
                return '<span class="label label-sm label-success">生效中</span>';
                break;
            case self::$_STATUS_CLOSED:
                return '<span class="label label-sm label-important">已关闭</span>';
                break;
            case self::$_STATUS_FINISHED:
                return '<span class="label label-sm label-warning">已结束</span>';
                break;
            case self::$_STATUS_STOCKOUT:
                return '<span class="label label-sm label-danger">库存不足</span>';
                break;

        }
    }

    /**根据活动状态返回对应操作
     * @param $row
     * @return string
     */
    public function sGetAction($row){
        $delOption = [
            'class'         =>  'btn btn-xs btn-warning',
            'data-confirm'  =>  '确定要删除'
        ];
        switch ($row['status']) {
            case self::$_STATUS_UNSTART:
                return  Html::a('编辑', ['edit', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
               // Html::a('删除', ['delete', 'id' =>$row['pd_id']], $delOption).'&nbsp;'.
                Html::a('暂停', ['stop', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-primary',]);

                break;
            case self::$_STATUS_STARTING:
                return  Html::a('编辑', ['edit', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
                //Html::a('删除', ['delete', 'id' =>$row['pd_id']], $delOption).'&nbsp;'.
                Html::a('暂停', ['stop', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-primary',]);
                break;
            case self::$_STATUS_FINISHED:
                return Html::a('查看', ['details', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-success',]);
                break;
            case self::$_STATUS_STOCKOUT:
                return Html::a('查看', ['details', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-success',]);
                break;
            case self::$_STATUS_CLOSED:
                return  Html::a('编辑', ['edit', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
                //Html::a('删除', ['delete', 'id' =>$row['pd_id']], $delOption).'&nbsp;'.
                Html::a('开始', ['start', 'id' =>$row['pd_id']], ['class' => 'btn btn-xs btn-primary',]);
                break;
        }
    }
    public static function agetDiscountInfoById($param){
        $discountInfo=array();
        if(isset($param['id'])&&$param['id']){
           $discountInfo=SmartPriceDiscount::find()->where('pd_id='.$param['id'])->asArray()->one();
         }

        return $discountInfo;
    }
    public function bStopDiscount($id){
          $model=SmartPriceDiscount::findOne($id);
          $model->status=3;
       // $this->setAttributes($data,false);
        return $model->save();
    }
    public function bStartDiscount($id){
        $model=SmartPriceDiscount::findOne($id);
        $model->status=1;
        // $this->setAttributes($data,false);
        return $model->save();
    }
    public function bDeleteDiscount($id){
        $model=SmartPriceDiscount::findOne($id);
        $model->status=1;
        // $this->setAttributes($data,false);
        return $model->save();
    }
}
?>