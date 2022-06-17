<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\apps\TDailyReportLine;

/**
 * TDailyReportLineSearch represents the model behind the search form of `app\models\apps\TDailyReportLine`.
 */
class TDailyReportLineSearch extends TDailyReportLine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_daily_report_line_id', 't_daily_report_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['labor_skill', 'activity', 'material_type', 'tool_type', 'uom_1', 'uom_2', 'uom_3', 'status'], 'safe'],
            [['qty_1', 'qty_2'], 'number'],
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
        $query = TDailyReportLine::find();

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
            't_daily_report_line_id' => $this->t_daily_report_line_id,
            't_daily_report_id' => $this->t_daily_report_id,
            't_project_id' => $this->t_project_id,
            'qty_1' => $this->qty_1,
            'qty_2' => $this->qty_2,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'labor_skill', $this->labor_skill])
            ->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'material_type', $this->material_type])
            ->andFilterWhere(['like', 'tool_type', $this->tool_type])
            ->andFilterWhere(['like', 'uom_1', $this->uom_1])
            ->andFilterWhere(['like', 'uom_2', $this->uom_2])
            ->andFilterWhere(['like', 'uom_3', $this->uom_3])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
