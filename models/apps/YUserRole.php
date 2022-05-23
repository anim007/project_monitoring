<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "y_user_role".
 *
 * @property int $y_user_role_id
 * @property int $y_user_id
 * @property int $y_role_id
 *
 * @property User $yUser
 * @property YRole $yRole
 */
class YUserRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'y_user_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['y_user_id', 'y_role_id'], 'required'],
            [['y_user_id', 'y_role_id'], 'integer'],
            [['y_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['y_user_id' => 'id']],
            [['y_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => YRole::className(), 'targetAttribute' => ['y_role_id' => 'y_role_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'y_user_role_id' => Yii::t('app', 'Y User Role ID'),
            'y_user_id' => Yii::t('app', 'User'),
            'y_role_id' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * Gets query for [[YUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYUser()
    {
        return $this->hasOne(User::className(), ['id' => 'y_user_id']);
    }

    /**
     * Gets query for [[YRole]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYRole()
    {
        return $this->hasOne(YRole::className(), ['y_role_id' => 'y_role_id']);
    }
}
