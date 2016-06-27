<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "opm_op_system_notice".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $status
 * @property string $creatTime
 * @property integer $uid
 * @property string $uname
 * @property string $upTime
 * @property integer $upuid
 * @property string $upuname
 */
class OpmOpSystemNotice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opm_op_system_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string'],
            [['status', 'uid', 'upuid'], 'integer'],
            [['creatTime', 'upTime'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['uname', 'upuname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '公告ID'),
            'title' => Yii::t('app', '公告标题'),
            'url' => Yii::t('app', '公告URL'),
            'status' => Yii::t('app', '状态'),//0:未发布  1:已发布 2:删除 3:已结束
            'creatTime' => Yii::t('app', '创建时间'),
            'uid' => Yii::t('app', '创建人ID'),
            'uname' => Yii::t('app', '创建人'),
            'upTime' => Yii::t('app', '更新时间'),
            'upuid' => Yii::t('app', '更新用户ID'),
            'upuname' => Yii::t('app', '更改用户名称'),
        ];
    }

    /**
     * @inheritdoc
     * @return OpmOpSystemNoticeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpmOpSystemNoticeQuery(get_called_class());
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OpmOpSystemNotice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'upTime' => $this->upTime,
            'url' => $this->url,
            'status' => $this->status,
            'creatTime' => $this->creatTime,
            'uid' => $this->uid,
            'upuid'=>$this->upuid,
        ]);

        $query->andFilterWhere(['like', 'uname', $this->uname])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'upuname', $this->upuname]);

        return $dataProvider;
    }
}
