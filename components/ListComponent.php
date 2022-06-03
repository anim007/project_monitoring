<?php

namespace app\components;

use app\models\apps\MBpartner;
use Yii;
use yii\helpers\ArrayHelper;

use app\models\apps\YMenu;
use app\models\apps\YRole;
use yii\db\Query;

class ListComponent extends \yii\base\Component
{
    public static $listData;

    public static function getListParentMenu()
    {
        $datas = YMenu::find()->where(['aktif' => 1])
            ->andWhere(['is', 'parent_id', null])
            ->all();
        $listData = ArrayHelper::map($datas, 'id', 'nama');

        return $listData;
    }

    public static function getListMenu()
    {
        $datas = YMenu::find()
            ->select(['y_menu.id', 'concat(coalesce(concat(parent.nama, \' > \'), \'\'), y_menu.nama) as nama'])
            ->leftJoin('y_menu as parent', 'parent.id = y_menu.parent_id')
            ->where(['is not', 'y_menu.parent_id', null])
            ->orWhere(['<>', 'y_menu.url', '#'])
            ->all();

        $listData = ArrayHelper::map($datas, 'id', 'nama');

        return $listData;
    }

    public static function getListRole()
    {
        $datas = YRole::find()->where(['role_aktif' => 1])->all();
        $listData = ArrayHelper::map($datas, 'y_role_id', 'nama');

        return $listData;
    }

    public static function getListBPartner($type = null)
    {
        $datas = MBpartner::find()->where(['status' => '1']);
        if (!is_null($type)) $datas = $datas->andWhere(['type' => $type]);
        $datas = $datas->all();
        $listData = ArrayHelper::map($datas, 'm_bpartner_id', 'first_name');

        return $listData;
    }

    public static function getListStatusUser()
    {
        $listData = [
            0 => 'Tidak Aktif',
            10 => 'Aktif'
        ];
        return $listData;
    }

    public static function getListPartnerType()
    {
        $listData = [
            'employee' => 'Employee',
            'vendor' => 'Vendor',
            'customer' => 'Customer', 
        ];
        return $listData;
    }

    public static function getListDataStatus()
    {
        $listData = [
            '0' => 'Tidak Aktif',
            '1' => 'Aktif'
        ];
        return $listData;
    }

    public static function getListProjectStatus()
    {
        $listData = [
            'upcoming' => 'Upcoming',
            'onprogress' => 'On Progress',
            'finish' => 'Finish', 
        ];
        return $listData;
    }

    public static function getListActivityStatus()
    {
        $listData = [
            'open' => 'Open',
            'onprogress' => 'On Progress',
            'finish' => 'Finish', 
        ];
        return $listData;
    }
}
