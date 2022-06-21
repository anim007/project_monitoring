<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\apps\TActivityDoc;

/**
 * TActivityDocSearch represents the model behind the search form of `app\models\apps\TActivityDoc`.
 */
class TActivityDocSearch extends TActivityDoc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_activity_doc_id', 't_activity_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['file_path', 'description', 'date'], 'safe'],
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
        $query = TActivityDoc::find();

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
            't_activity_doc_id' => $this->t_activity_doc_id,
            't_activity_id' => $this->t_activity_id,
            't_project_id' => $this->t_project_id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
