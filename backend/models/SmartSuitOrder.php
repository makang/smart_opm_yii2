<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "smart_suit_order".
 *
 * @property string $id
 * @property string $order_id
 * @property integer $pid
 * @property string $cinema_no
 * @property integer $suit_id
 * @property integer $uid
 * @property integer $fee
 * @property integer $status
 * @property integer $create_time
 * @property string $update_time
 */
class SmartSuitOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_suit_order';
    }
    public static function getStatus(){
        return array(
            1 =>'未支付',
            99=>'已支付',
            2 =>'未发码',
            3 =>'已发码',
            4 =>'已核销',
            5 =>'退款中',
            6 =>'退款处理中',
            7 =>'已退款',
            8 =>'已过期'
            // 99 2 3 8 4
            //1：未支付，99：已支付，2：未发码，3：已发码，4：已核销，5：退款申请中，6：退款处理中，7：已退款
        );
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['pid', 'suit_id', 'uid', 'fee', 'status', 'create_time'], 'integer'],
            [['update_time'], 'safe'],
            [['id', 'order_id'], 'string', 'max' => 32],
            [['cinema_no'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', '主订单id'),
            'pid' => Yii::t('app', '公众号id'),
            'cinema_no' => Yii::t('app', '影院id'),
            'suit_id' => Yii::t('app', '卖品id'),
            'uid' => Yii::t('app', '用户id'),
            'fee' => Yii::t('app', '订单总额 单位 分'),
            'status' => Yii::t('app', '订单状态 1：未支付，99：已支付，2：未发码，3：已发码，4：已核销，5：退款申请中，6：退款处理中，7：已退款,8:订单已过期'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params)
    {
        $query = SmartSuitOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        if (isset($params['start_date']) || isset($params['end_date'])) {
            if ($params['start_date'] && $params['end_date']) {
                $query->where("create_time between '" .strtotime( $params['start_date']) . "' and '" . strtotime($params['end_date']) . "'");
            } elseif ($params['start_date']) {
                $query->where("create_time>='" .strtotime( $params['start_date']) . "'");
            } elseif ($params['end_date']) {
                $query->where("create_time<='" .strtotime( $params['end_date']) . "'");
            }
        }
        !empty($params['status'])?$query->andWhere(['status'=>$params['status']]):'';
        !empty($params['suit_id'])?$query->andWhere(['suit_id'=>$params['suit_id']]):'';
        !empty($params['order_id'])?$query->andWhere(['order_id'=>$params['order_id']]):'';

        $query->OrderBy('create_time desc');
        return $dataProvider;
    }
}
