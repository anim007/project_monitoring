<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "y_role".
 *
 * @property int $y_role_id
 * @property string $nama
 * @property string|null $deskripsi
 * @property int $role_aktif
 *
 * @property YRoleMenu[] $yRoleMenus
 * @property YUserRole[] $yUserRoles
 */
class YRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'y_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['role_aktif'], 'integer'],
            [['nama', 'deskripsi'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'y_role_id' => Yii::t('app', 'Role ID'),
            'nama' => Yii::t('app', 'Nama'),
            'deskripsi' => Yii::t('app', 'Deskripsi'),
            'role_aktif' => Yii::t('app', 'Role Aktif'),
        ];
    }

    /**
     * Gets query for [[YRoleMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYRoleMenus()
    {
        return $this->hasMany(YRoleMenu::className(), ['y_role_id' => 'y_role_id']);
    }

    /**
     * Gets query for [[YUserRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYUserRoles()
    {
        return $this->hasMany(YUserRole::className(), ['y_role_id' => 'y_role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYRoleMenuIDs()
    {
        $ids = array();
        foreach ($this->yRoleMenus as $rMenus)
            $ids[] = $rMenus->id;
        return $ids;
    }
}
