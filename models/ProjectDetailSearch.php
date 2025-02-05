<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectDetail;

/**
 * ProjectDetailSearch represents the model behind the search form of `app\models\ProjectDetail`.
 */
class ProjectDetailSearch extends ProjectDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'detail_id', 'count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $isMissing = false)
    {
        $query = ProjectDetail::find();
        if ($isMissing) {
            $query->where(['<', 'count', 0]);
        }
        else {
            $query->where(['>', 'count', 0]);
        }

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
            'project_id' => $this->project_id,
            'detail_id' => $this->detail_id,
            'count' => $this->count,
        ]);

        return $dataProvider;
    }
}
