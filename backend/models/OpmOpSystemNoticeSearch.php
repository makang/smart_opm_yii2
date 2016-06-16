<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OpmOpSystemNotice;

/**
 * ArticleSearch represents the model behind the search form about `backend\models\Article`.
 */
class OpmOpSystemNoticeSearch extends OpmOpSystemNotice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['url'], 'required'],
            [['url'], 'string'],
            [['status', 'id','uid', 'upuid'], 'integer'],
            [['creatTime', 'upTime'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['uname', 'upuname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
