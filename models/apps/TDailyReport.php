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
 * @property int $updated_by
 *
 * @property TProject $tProject
 * @property User $createdBy
 * @property User $updaedBy
 * @property TDailyReportLine[] $tDailyReportLines
 */
class TDailyReport extends \yii\db\ActiveRecord
{

    public $file1;

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
            [['t_project_id', 'date'], 'required'],
            [['t_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date'], 'safe'],
            [['file_path', 'description'], 'string'],
            [['weather_1', 'weather_2', 'weather_3', 'weather_4', 'work_hour_1', 'work_hour_2'], 'string', 'max' => 50],
            [['file1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, jpeg'],
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
            't_daily_report_id' => Yii::t('app', 'Daily Report ID'),
            't_project_id' => Yii::t('app', 'Project'),
            'date' => Yii::t('app', 'Date'),
            'file_path' => Yii::t('app', 'Attachment'),
            'file1' => Yii::t('app', 'Attachment'),
            'description' => Yii::t('app', 'Description'),
            'work_hour_1' => Yii::t('app', 'Noon WH'),
            'work_hour_2' => Yii::t('app', 'Night WH'),
            'weather_1' => Yii::t('app', 'Morning Weather'),
            'weather_2' => Yii::t('app', 'Noon Weather'),
            'weather_3' => Yii::t('app', 'Afternoon Weather'),
            'weather_4' => Yii::t('app', 'Night Weather'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updaed By'),
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
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdaedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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

    /**
     * Upload file.
     *
     * @return true/false
     */
    public function uploadFile($field, $attr)
    {
        $path       = null;
        $model      = $this;
        $old_url    = $model[$field];

        $model[$attr] = \yii\web\UploadedFile::getInstance($model, $attr);

        if (is_null($model[$attr])) {
            return true;
        }

        if (!is_null($model[$attr])) {
            $path = 'files/images/laporan/'  . 'att_' . date('YmdHis') . '_' . $model[$attr]->name;
            $model[$attr]->saveAs($path);
            if ($old_url != null && !empty($old_url)) {
                $old_url = Yii::$app->basePath . '/web/' . $old_url;
                if (is_dir($old_url)) unlink($old_url);
            }
            $model[$attr] = '';
            $model[$field] = $path;
            return true;
        } else {
            return false;
        }

        return false;
    }
}
