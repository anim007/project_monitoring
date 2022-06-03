<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "t_project".
 *
 * @property int $m_project_id
 * @property int|null $m_bpartner_id
 * @property int|null $pic_id
 * @property string $value
 * @property string $name
 * @property string|null $start_date
 * @property string|null $finish_date
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property TActivity[] $tActivities
 * @property TActivityDoc[] $tActivityDocs
 * @property TDailyReport[] $tDailyReports
 * @property TDailyReportLine[] $tDailyReportLines
 * @property MBpartner $mBpartner
 * @property MBpartner $pic
 */
class TProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_project';
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
            [['value', 'name', 'status'], 'required'],
            [['m_bpartner_id', 'pic_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['start_date', 'finish_date'], 'safe'],
            [['value', 'name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 20],
            [['m_bpartner_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBpartner::className(), 'targetAttribute' => ['m_bpartner_id' => 'm_bpartner_id']],
            [['pic_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBpartner::className(), 'targetAttribute' => ['pic_id' => 'm_bpartner_id']],
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
            'm_project_id' => Yii::t('app', 'Project ID'),
            'm_bpartner_id' => Yii::t('app', 'Vendor'),
            'pic_id' => Yii::t('app', 'PIC'),
            'value' => Yii::t('app', 'Value'),
            'name' => Yii::t('app', 'Name'),
            'start_date' => Yii::t('app', 'Start Date'),
            'finish_date' => Yii::t('app', 'Finish Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[TActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTActivities()
    {
        return $this->hasMany(TActivity::className(), ['t_project_id' => 'm_project_id']);
    }

    /**
     * Gets query for [[TActivityDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTActivityDocs()
    {
        return $this->hasMany(TActivityDoc::className(), ['t_project_id' => 'm_project_id']);
    }

    /**
     * Gets query for [[TDailyReports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTDailyReports()
    {
        return $this->hasMany(TDailyReport::className(), ['t_project_id' => 'm_project_id']);
    }

    /**
     * Gets query for [[TDailyReportLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTDailyReportLines()
    {
        return $this->hasMany(TDailyReportLine::className(), ['t_project_id' => 'm_project_id']);
    }

    /**
     * Gets query for [[MBpartner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMBpartner()
    {
        return $this->hasOne(MBpartner::className(), ['m_bpartner_id' => 'm_bpartner_id']);
    }

    /**
     * Gets query for [[Pic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPic()
    {
        return $this->hasOne(MBpartner::className(), ['m_bpartner_id' => 'pic_id']);
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
