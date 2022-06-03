<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "t_activity".
 *
 * @property int $t_activity_id
 * @property int $t_project_id
 * @property string $name
 * @property string|null $descripiton
 * @property int $heaviness
 * @property string $start_date
 * @property string|null $est_finish_date
 * @property string|null $finish_date
 * @property string $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property TProject $tProject
 * @property TActivityDoc[] $tActivityDocs
 */
class TActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_project_id', 'name', 'heaviness', 'start_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['t_project_id', 'heaviness', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['descripiton'], 'string'],
            [['start_date', 'est_finish_date', 'finish_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
            [['t_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TProject::className(), 'targetAttribute' => ['t_project_id' => 'm_project_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            't_activity_id' => Yii::t('app', 'T Activity ID'),
            't_project_id' => Yii::t('app', 'T Project ID'),
            'name' => Yii::t('app', 'Name'),
            'descripiton' => Yii::t('app', 'Descripiton'),
            'heaviness' => Yii::t('app', 'Heaviness'),
            'start_date' => Yii::t('app', 'Start Date'),
            'est_finish_date' => Yii::t('app', 'Est Finish Date'),
            'finish_date' => Yii::t('app', 'Finish Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
     * Gets query for [[TActivityDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTActivityDocs()
    {
        return $this->hasMany(TActivityDoc::className(), ['t_activity_id' => 't_activity_id']);
    }
}