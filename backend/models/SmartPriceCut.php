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

class SmartPriceCut extends \yii\db\ActiveRecord
{
    protected STATIC $_STATUS_DELETED       = 0;        //已删除
    protected STATIC $_STATUS_UNSTART       = 1;        //未开始
    protected STATIC $_STATUS_STARTING      = 2;        //进行中
    protected STATIC $_STATUS_FINISHED      = 3;        //已结束
    protected STATIC $_STATUS_STOP          = 4;        //暂停


    public STATIC $_STATUS_SHOW = array(
        ''=>'全部',
        0=>'已删除',
        1=>'未开始',
        2=>'进行中',
        3=>'已结束',
        4=>'暂停'

    );


    public static function tableName(){
        return "smart_price_cut";
    }


    public static function model($className=__CLASS__)
    {
        return new $className;
    }

    /**删除活动
     * @param $pcId
     * @return bool
     */
    public function bDelActivity($pcId){
        $res = $this::find()->where(['pc_id'=>$pcId])->one();
        $res->status = self::$_STATUS_DELETED;
        return $res->save();
    }

    /**开启活动
     * @param $pcId
     * @return bool
     */
    public function bStartActivity($pcId){
        $res = $this::find()->where(['pc_id'=>$pcId])->one();
        $res->status = self::$_STATUS_STARTING;
        return $res->save();
    }

    /**暂停活动
     * @param $pcId
     * @return bool
     */
    public function bStopActivity($pcId){
        $res = $this::find()->where(['pc_id'=>$pcId])->one();
        $res->status = self::$_STATUS_STOP;
        return $res->save();
    }

    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params){
        $query = SmartPriceCut::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        !empty($params['pc_id'])?$query->andFilterWhere(['pc_id'=>$params['pc_id']]):'';
        !empty($params['name'])?$query->andFilterWhere(['like','name',$params['name']]):'';
        isset($params['status']) && $params['status']!=='' ?$query->andFilterWhere(['status'=>$params['status']]):'';
        $query->addOrderBy('pc_id desc');

        $opOrders = array();
        foreach($dataProvider->getModels() as $v){
            $modelArray = $v->toArray();
            $ticketNum   =   SmartPriceCutLog::model()->iGetConsmeTicket($v->pc_id);
            $modelArray['ticket_num'] = $ticketNum;
            $sendMoney   =   SmartPriceCutExtends::model()->iGetSendMoney($v->pc_id);
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
            case self::$_STATUS_DELETED:
                return '<span class="label label-sm label-info arrowed arrowed-righ">已删除</span>';
                break;
            case self::$_STATUS_UNSTART:
                return '<span class="label label-sm label-success">未开始</span>';
                break;
            case self::$_STATUS_STARTING:
                return '<span class="label label-sm label-important">进行中</span>';
                break;
            case self::$_STATUS_FINISHED:
                return '<span class="label label-sm label-warning">已结束</span>';
                break;
            case self::$_STATUS_STOP:
                return '<span class="label label-sm label-danger">暂停</span>';
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
            case self::$_STATUS_DELETED:
                return Html::a('查看', ['details', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-success',]);
                break;
            case self::$_STATUS_UNSTART:
                return  Html::a('编辑', ['edit', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
                        Html::a('删除', ['delete', 'id' =>$row['pc_id']], $delOption).'&nbsp;'.
                        Html::a('暂停', ['stop', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-primary',]);

                break;
            case self::$_STATUS_STARTING:
                return  Html::a('编辑', ['edit', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
                Html::a('删除', ['delete', 'id' =>$row['pc_id']], $delOption).'&nbsp;'.
                Html::a('暂停', ['stop', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-primary',]);
                break;
            case self::$_STATUS_FINISHED:
                return Html::a('查看', ['details', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-success',]);
                break;
            case self::$_STATUS_STOP:
                return  Html::a('编辑', ['edit', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-info',]).'&nbsp;'.
                Html::a('删除', ['delete', 'id' =>$row['pc_id']], $delOption).'&nbsp;'.
                Html::a('开始', ['start', 'id' =>$row['pc_id']], ['class' => 'btn btn-xs btn-primary',]);
                break;
        }
    }


}
?>