<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "y_role_menu".
 *
 * @property int $id
 * @property int $y_role_id
 * @property int $y_menu_id
 * @property int $is_default
 * @property int $is_tampil
 * @property int $is_readonly
 *
 * @property YRole $yRole
 * @property YMenu $yMenu
 */
class YRoleMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'y_role_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['y_role_id', 'y_menu_id'], 'required'],
            [['y_role_id', 'y_menu_id', 'is_default', 'is_tampil', 'is_readonly'], 'integer'],
            [['y_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => YRole::className(), 'targetAttribute' => ['y_role_id' => 'y_role_id']],
            [['y_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => YMenu::className(), 'targetAttribute' => ['y_menu_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'y_role_id' => Yii::t('app', 'Role'),
            'y_menu_id' => Yii::t('app', 'Menu'),
            'is_default' => Yii::t('app', 'Is Default'),
            'is_tampil' => Yii::t('app', 'Is Tampil'),
            'is_readonly' => Yii::t('app', 'Is Read Only'),
        ];
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

    /**
     * Gets query for [[YMenu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYMenu()
    {
        return $this->hasOne(YMenu::className(), ['id' => 'y_menu_id']);
    }
}
