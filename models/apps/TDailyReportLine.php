<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "t_daily_report_line".
 *
 * @property int $t_daily_report_line_id
 * @property int $t_daily_report_id
 * @property int $t_project_id
 * @property string|null $labor_skill
 * @property string|null $activity
 * @property string|null $material_type
 * @property string|null $tool_type
 * @property float|null $qty_1
 * @property float|null $qty_2
 * @property string|null $uom_1
 * @property string|null $uom_2
 * @property string|null $uom_3
 * @property string $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property TDailyReport $tDailyReport
 * @property TProject $tProject
 * @property User $createdBy
 * @property User $updatedBy
 */
class TDailyReportLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_daily_report_line';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_daily_report_id', 't_project_id', 'status'], 'required'],
            [['t_daily_report_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['qty_1', 'qty_2'], 'number'],
            [['labor_skill'], 'string', 'max' => 100],
            [['activity', 'material_type', 'tool_type'], 'string', 'max' => 255],
            [['uom_1', 'uom_2', 'uom_3', 'status'], 'string', 'max' => 10],
            [['t_daily_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => TDailyReport::className(), 'targetAttribute' => ['t_daily_report_id' => 't_daily_report_id']],
            [['t_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TProject::className(), 'targetAttribute' => ['t_project_id' => 'm_project_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            't_daily_report_line_id' => Yii::t('app', 'Daily Report Line ID'),
            't_daily_report_id' => Yii::t('app', 'Daily Report'),
            't_project_id' => Yii::t('app', 'Project'),
            'labor_skill' => Yii::t('app', 'Labor Skill'),
            'activity' => Yii::t('app', 'Activity'),
            'material_type' => Yii::t('app', 'Material Type'),
            'tool_type' => Yii::t('app', 'Tool Type'),
            'qty_1' => Yii::t('app', 'Qty 1'),
            'qty_2' => Yii::t('app', 'Qty 2'),
            'uom_1' => Yii::t('app', 'Uom 1'),
            'uom_2' => Yii::t('app', 'Uom 2'),
            'uom_3' => Yii::t('app', 'Uom 3'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[TDailyReport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTDailyReport()
    {
        return $this->hasOne(TDailyReport::className(), ['t_daily_report_id' => 't_daily_report_id']);
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
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
