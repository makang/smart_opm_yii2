<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "smart_order_statistic".
 *
 * @property integer $id
 * @property string $order_day
 * @property string $cinema_no
 * @property string $cinema_name
 * @property string $public_id
 * @property string $order_num
 * @property string $ticket_num
 * @property string $pay_money
 * @property string $refund_num
 * @property string $refund_money
 * @property string $total_fee
 * @property string $member_num
 * @property string $no_member_num
 * @property integer $suits_order_totals
 * @property integer $suits_order_money_totals
 */
class SmartOrderStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_order_statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_day', 'cinema_no', 'cinema_name', 'public_id', 'order_num', 'ticket_num', 'pay_money', 'refund_num', 'refund_money', 'total_fee', 'member_num', 'no_member_num'], 'required'],
            [['suits_order_totals', 'suits_order_money_totals'], 'integer'],
            [['order_day', 'cinema_no', 'order_num', 'pay_money', 'refund_money', 'total_fee', 'no_member_num'], 'string', 'max' => 25],
            [['cinema_name'], 'string', 'max' => 50],
            [['public_id'], 'string', 'max' => 15],
            [['ticket_num', 'refund_num', 'member_num'], 'string', 'max' => 20],
            [['cinema_no', 'order_day', 'public_id'], 'unique', 'targetAttribute' => ['cinema_no', 'order_day', 'public_id'], 'message' => 'The combination of 订单日期, 影院编号 and 公众号编号 has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'order_day' => Yii::t('app', '订单日期'),
            'cinema_no' => Yii::t('app', '影院编号'),
            'cinema_name' => Yii::t('app', '影院名称'),
            'public_id' => Yii::t('app', '公众号编号'),
            'order_num' => Yii::t('app', '订单数目'),
            'ticket_num' => Yii::t('app', '出票总额'),
            'pay_money' => Yii::t('app', '订单总额'),
            'refund_num' => Yii::t('app', '退款数目'),
            'refund_money' => Yii::t('app', '退款总额'),
            'total_fee' => Yii::t('app', '服务费总额'),
            'member_num' => Yii::t('app', '会员购票数'),
            'no_member_num' => Yii::t('app', '非会员购票数'),
            'suits_order_totals' => Yii::t('app', '卖品订单总数'),
            'suits_order_money_totals' => Yii::t('app', '卖品订单销售额'),
        ];
    }
    public function oSearch($params)
    {
        $query = SmartOrderStatistic::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if ($this->validate()) {
            return $dataProvider;
        }
        $query->select('id ,order_day,sum(ticket_num) ticket_num,sum(pay_money) pay_money,sum(order_num) order_num,sum(total_fee) total_fee, sum(member_num) member_num,sum(suits_order_totals) suits_order_totals,sum(suits_order_money_totals) suits_order_money_totals');
        if(isset($params['start_date'])||isset($params['end_date'])) {
            if ($params['start_date'] && $params['end_date']) {
                $query->where("order_day between '" . $params['start_date'] . "' and '" . $params['end_date'] . "'");
            } elseif ($params['start_date']) {
                $query->where("order_day>='" . $params['start_date'] . "'");
            } elseif ($params['end_date']) {
                $query->where("order_day<='" . $params['end_date'] . "'");
            }
        }
        $query->groupBy('order_day');
        $query->orderBy(['order_day' => SORT_DESC])->asArray()->all();
        return $dataProvider;
    }
}
