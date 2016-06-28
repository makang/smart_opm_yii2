<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "smart_publicsignal_statistics".
 *
 * @property integer $id
 * @property string $publicsignalshort
 * @property string $publicsignalname
 * @property integer $new_user
 * @property integer $cancel_user
 * @property integer $increase_user
 * @property integer $cumulate_user
 * @property integer $total_orders
 * @property integer $total_sales
 * @property integer $suits_order_totals
 * @property integer $suits_order_money_totals
 * @property string $create_time
 */
class SmartPublicsignalStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_publicsignal_statistics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publicsignalshort'], 'required'],
            [['new_user', 'cancel_user', 'increase_user', 'cumulate_user', 'total_orders', 'total_sales', 'suits_order_totals', 'suits_order_money_totals'], 'integer'],
            [['create_time'], 'safe'],
            [['publicsignalshort'], 'string', 'max' => 25],
            [['publicsignalname'], 'string', 'max' => 255],
            [['publicsignalshort', 'create_time'], 'unique', 'targetAttribute' => ['publicsignalshort', 'create_time'], 'message' => 'The combination of 公众号缩写 and 创建时间 has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publicsignalshort' => Yii::t('app', '公众号缩写'),
            'publicsignalname' => Yii::t('app', '公众号名称'),
            'new_user' => Yii::t('app', '新用户'),
            'cancel_user' => Yii::t('app', '取消关注用户'),
            'increase_user' => Yii::t('app', '净增长用户'),
            'cumulate_user' => Yii::t('app', '用户总数'),
            'total_orders' => Yii::t('app', '订单总数'),
            'total_sales' => Yii::t('app', '销售额'),
            'suits_order_totals' => Yii::t('app', '卖品订单总数'),
            'suits_order_money_totals' => Yii::t('app', '卖品订单销售额'),
            'create_time' => Yii::t('app', '创建时间'),
        ];
    }

    public function oSearch($params)
    {
        $query = SmartPublicsignalStatistics::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if ($this->validate()) {
            return $dataProvider;
        }
        $query->select('id , publicsignalname, sum(new_user) new_user,sum(cancel_user) cancel_user,sum(increase_user) increase_user,max(cumulate_user) cumulate_user,sum(total_orders) total_orders,sum(total_sales)/100 total_sales,sum(suits_order_totals) suits_order_totals,sum(suits_order_money_totals)/100 suits_order_money_totals ');
        if (isset($params['start_date']) || isset($params['end_date'])) {
            if ($params['start_date'] && $params['end_date']) {
                $query->where("create_time between '" . $params['start_date'] . "' and '" . $params['end_date'] . "'");
            } elseif ($params['start_date']) {
                $query->where("create_time>='" . $params['start_date'] . "'");
            } elseif ($params['end_date']) {
                $query->where("create_time<='" . $params['end_date'] . "'");
            }
        }
        if (isset($params['publicsignalname'])) {
            $query->andFilterWhere(['like', 'publicsignalname', $params['publicsignalname']]);
        }
        $sort = (isset($params['orderby']) && $params['orderby']) ? $params['orderby'] : 'create_time';

        $query->groupBy('publicsignalshort');
        $query->orderBy([$sort => SORT_DESC]);

        return $dataProvider;
    }
}
