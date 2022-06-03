<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "t_daily_report".
 *
 * @property int $t_daily_report_id
 * @property int $t_project_id
 * @property string $date
 * @property string $file_path
 * @property string|null $description
 * @property string|null $work_hour_1
 * @property string|null $work_hour_2
 * @property string|null $weather_1
 * @property string|null $weather_2
 * @property string|null $weather_3
 * @property string|null $weather_4
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updaed_by
 *
 * @property TProject $tProject
 * @property YUser $createdBy
 * @property YUser $updaedBy
 * @property TDailyReportLine[] $tDailyReportLines
 */
class TDailyReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_daily_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_project_id', 'date', 'file_path', 'created_at', 'created_by', 'updated_at', 'updaed_by'], 'required'],
            [['t_project_id', 'created_at', 'created_by', 'updated_at', 'updaed_by'], 'integer'],
            [['date', 'work_hour_1', 'work_hour_2'], 'safe'],
            [['file_path', 'description'], 'string'],
            [['weather_1', 'weather_2', 'weather_3', 'weather_4'], 'string', 'max' => 50],
            [['t_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TProject::className(), 'targetAttribute' => ['t_project_id' => 'm_project_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => YUser::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updaed_by'], 'exist', 'skipOnError' => true, 'targetClass' => YUser::className(), 'targetAttribute' => ['updaed_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            't_daily_report_id' => Yii::t('app', 'T Daily Report ID'),
            't_project_id' => Yii::t('app', 'T Project ID'),
            'date' => Yii::t('app', 'Date'),
            'file_path' => Yii::t('app', 'File Path'),
            'description' => Yii::t('app', 'Description'),
            'work_hour_1' => Yii::t('app', 'Work Hour 1'),
            'work_hour_2' => Yii::t('app', 'Work Hour 2'),
            'weather_1' => Yii::t('app', 'Weather 1'),
            'weather_2' => Yii::t('app', 'Weather 2'),
            'weather_3' => Yii::t('app', 'Weather 3'),
            'weather_4' => Yii::t('app', 'Weather 4'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updaed_by' => Yii::t('app', 'Updaed By'),
        ];
    }

    /**
     * Gets query for [[TProject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTProject()
    {
        return $this->hasOne(TProject::className(), ['m_project_id' => 't_project_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(YUser::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdaedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdaedBy()
    {
        return $this->hasOne(YUser::className(), ['id' => 'updaed_by']);
    }

    /**
     * Gets query for [[TDailyReportLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTDailyReportLines()
    {
        return $this->hasMany(TDailyReportLine::className(), ['t_daily_report_id' => 't_daily_report_id']);
    }
}
