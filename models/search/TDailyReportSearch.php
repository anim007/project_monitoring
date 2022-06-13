<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\apps\TDailyReport;

/**
 * TDailyReportSearch represents the model behind the search form of `app\models\apps\TDailyReport`.
 */
class TDailyReportSearch extends TDailyReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_daily_report_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date', 'file_path', 'description', 'work_hour_1', 'work_hour_2', 'weather_1', 'weather_2', 'weather_3', 'weather_4'], 'safe'],
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
        $query = TDailyReport::find();

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
            't_daily_report_id' => $this->t_daily_report_id,
            't_project_id' => $this->t_project_id,
            'date' => $this->date,
            'work_hour_1' => $this->work_hour_1,
            'work_hour_2' => $this->work_hour_2,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'weather_1', $this->weather_1])
            ->andFilterWhere(['like', 'weather_2', $this->weather_2])
            ->andFilterWhere(['like', 'weather_3', $this->weather_3])
            ->andFilterWhere(['like', 'weather_4', $this->weather_4]);

        return $dataProvider;
    }
}
