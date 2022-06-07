<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "y_menu".
 *
 * @property int $id
 * @property string $nama
 * @property string $url
 * @property string|null $icon
 * @property string|null $group
 * @property int|null $parent_id
 * @property int $aktif
 *
 * @property YMenu $parent
 * @property YMenu[] $yMenus
 * @property YRoleMenu[] $yRoleMenus
 */
class YMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'y_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'url', 'aktif'], 'required'],
            [['parent_id', 'aktif'], 'integer'],
            [['nama', 'url'], 'string', 'max' => 256],
            [['group'], 'string', 'max' => 20],
            [['icon'], 'string', 'max' => 50],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => YMenu::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama' => Yii::t('app', 'Nama'),
            'url' => Yii::t('app', 'Url'),
            'icon' => Yii::t('app', 'Icon'),
            'group' => Yii::t('app', 'Group'),
            'parent_id' => Yii::t('app', 'Parent'),
            'aktif' => Yii::t('app', 'Aktif'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(YMenu::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[YMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYMenus()
    {
        return $this->hasMany(YMenu::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[YRoleMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYRoleMenus()
    {
        return $this->hasMany(YRoleMenu::className(), ['y_menu_id' => 'id']);
    }
}
