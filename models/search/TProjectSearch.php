<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\apps\TProject;

/**
 * TProjectSearch represents the model behind the search form of `app\models\apps\TProject`.
 */
class TProjectSearch extends TProject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['m_project_id', 'm_bpartner_id', 'pic_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['value', 'name', 'start_date', 'finish_date', 'status'], 'safe'],
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
    public function search($params)
    {
        $query = TProject::find();

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
            'm_project_id' => $this->m_project_id,
            'm_bpartner_id' => $this->m_bpartner_id,
            'pic_id' => $this->pic_id,
            'start_date' => $this->start_date,
            'finish_date' => $this->finish_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
