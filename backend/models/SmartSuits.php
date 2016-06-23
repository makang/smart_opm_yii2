<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smart_suits".
 *
 * @property integer $sid
 * @property integer $pid
 * @property string $cinema_no
 * @property string $cinema_name
 * @property string $suit_name
 * @property string $suit_no
 * @property string $good_ids
 * @property integer $sell_price
 * @property integer $stock_num
 * @property integer $status
 * @property integer $code_type
 * @property string $thumb_url
 * @property integer $list_order
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $code_expire
 * @property integer $create_time
 * @property string $update_time
 * @property integer $admin_uid
 * @property string $admin_name
 */
class SmartSuits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_suits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sell_price', 'stock_num', 'status', 'code_type', 'list_order', 'start_time', 'end_time', 'code_expire', 'create_time', 'admin_uid'], 'integer'],
            [['thumb_url'], 'required'],
            [['thumb_url'], 'string'],
            [['update_time'], 'safe'],
            [['cinema_no'], 'string', 'max' => 10],
            [['cinema_name'], 'string', 'max' => 50],
            [['suit_name'], 'string', 'max' => 30],
            [['suit_no', 'admin_name'], 'string', 'max' => 20],
            [['good_ids'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sid' => Yii::t('app', 'Sid'),
            'pid' => Yii::t('app', '公众号id'),
            'cinema_no' => Yii::t('app', '影院id'),
            'cinema_name' => Yii::t('app', '影院名称'),
            'suit_name' => Yii::t('app', '卖品名称'),
            'suit_no' => Yii::t('app', '卖品货号'),
            'good_ids' => Yii::t('app', '商品id'),
            'sell_price' => Yii::t('app', '卖品售价'),
            'stock_num' => Yii::t('app', '卖品数量'),
            'status' => Yii::t('app', '卖品状态 0：未导码，1：未开售，2：已售罄 3：已停售，4：已结束，5：已删除 99： 售卖中 '),
            'code_type' => Yii::t('app', '发码类型 1: 外部导码  2:内部码'),
            'thumb_url' => Yii::t('app', '缩略图url'),
            'list_order' => Yii::t('app', '排序'),
            'start_time' => Yii::t('app', '售卖开始时间'),
            'end_time' => Yii::t('app', '售卖结束时间'),
            'code_expire' => Yii::t('app', '套餐码的到期类型：0：放映当天到期，N:购买后N天后到期'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'admin_uid' => Yii::t('app', 'Admin Uid'),
            'admin_name' => Yii::t('app', 'Admin Name'),
        ];
    }
    /*
     * 根据suit_id查询
     */
    public static function getName($suit_id,$name_type){
        $suit_name='';
        $cinema_name='';
        if($suit_id) {
            $suitInfo = SmartSuits::find($suit_id)->asArray()->one();
            if($suitInfo){
                $suit_name=$suitInfo['suit_name'];
                $cinema_name=$suitInfo['cinema_name'];
            }
        }
        if($name_type=='suit_name'){
           return $suit_name;
        }
        if($name_type=='cinema_name'){
           return $cinema_name;
        }
    }
}
