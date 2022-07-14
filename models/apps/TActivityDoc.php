<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "t_activity_doc".
 *
 * @property int $t_activity_doc_id
 * @property int $t_activity_id
 * @property int $t_project_id
 * @property string|null $file_path
 * @property string|null $description
 * @property string|null $date
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property TActivity $tActivity
 * @property TProject $tProject
 * @property User $createdBy
 * @property User $updatedBy
 */
class TActivityDoc extends \yii\db\ActiveRecord
{

    public $file1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_activity_doc';
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
            [['t_activity_id', 't_project_id', 'description', 'file_path', 'date'], 'required'],
            [['t_activity_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['file_path', 'description'], 'string'],
            [['date'], 'safe'],
            [['file1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, jpeg, mp4, mpg, mkv, wmv, avi'],
            [['t_activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => TActivity::className(), 'targetAttribute' => ['t_activity_id' => 't_activity_id']],
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
            't_activity_doc_id' => Yii::t('app', 'Activity Doc ID'),
            't_activity_id' => Yii::t('app', 'Activity'),
            't_project_id' => Yii::t('app', 'Project'),
            'file_path' => Yii::t('app', 'Attachment'),
            'file1' => Yii::t('app', 'Attachment'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[TActivity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTActivity()
    {
        return $this->hasOne(TActivity::className(), ['t_activity_id' => 't_activity_id']);
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
            $path = 'files/images/dokumentasi/'  . 'att_' . date('YmdHis') . '_' . $model[$attr]->name;
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

    public function isVideo()
    {
        $video = ['mp4', 'mpg', 'mkv', 'wmv', 'avi'];
        $format = is_null($this->file_path) ? null : substr($this->file_path, -3, 3);
        $bool = array_search($format, $video) !== false ? true : false;

        return $bool;
    }

    public function isImage()
    {
        $video = ['jpg', 'png', 'jpeg'];
        $format = is_null($this->file_path) ? null : substr($this->file_path, -3, 3);
        $bool = array_search($format, $video) !== false ? true : false;

        return $bool;
    }
}
