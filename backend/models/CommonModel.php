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
use backend\models;

class CommonModel extends \yii\db\ActiveRecord{

    public $tableName = '';

    /**gridview 条件筛选table
     * @param $params
     * @return ActiveDataProvider
     */
    public function oSearch($params,$model,$orderBy=''){
        $model='backend\models\\'.$model;
        $searchModel=new $model();
        $query = $searchModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $primaryKey = $searchModel->primaryKey();
        $orderBy = $orderBy?$orderBy:$primaryKey[0].' desc';

        $query->where($params);
        $query->addOrderBy($orderBy);
        return $dataProvider;
    }

}
?>