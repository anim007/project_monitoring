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
 * @property YUser $createdBy
 * @property YUser $updatedBy
 */
class TActivityDoc extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['t_activity_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['t_activity_id', 't_project_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['file_path', 'description'], 'string'],
            [['date'], 'safe'],
            [['t_activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => TActivity::className(), 'targetAttribute' => ['t_activity_id' => 't_activity_id']],
            [['t_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TProject::className(), 'targetAttribute' => ['t_project_id' => 'm_project_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => YUser::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => YUser::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            't_activity_doc_id' => Yii::t('app', 'T Activity Doc ID'),
            't_activity_id' => Yii::t('app', 'T Activity ID'),
            't_project_id' => Yii::t('app', 'T Project ID'),
            'file_path' => Yii::t('app', 'File Path'),
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
        return $this->hasOne(YUser::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(YUser::className(), ['id' => 'updated_by']);
    }
}
