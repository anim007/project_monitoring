<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php

            use app\models\apps\YMenu;
            use app\models\apps\YRoleMenu;
            use yii\helpers\ArrayHelper;

            if (!Yii::$app->user->isGuest) {
                $user = Yii::$app->user->identity;
                $menuItems = [];
                $menus = [];
                $items = [];
                $parent = [];
                // Jika login sebagai Super User maka menu muncul semua
                if (in_array(0, $user->yRoleIDs)) {
                    $menus = YMenu::find()->where(['aktif' => 1])->all();
                    foreach ($menus as $k => $v) {
                        $menus[$k] = $v->attributes;
                    }
                } else {
                    $roleMenus = YRoleMenu::find()->joinWith(['yMenu'])
                        ->where(['in', 'y_role_id', $user->yRoleIDs])
                        ->andWhere(['y_menu.aktif' => 1])
                        ->andWhere(['y_role_menu.is_tampil' => 1])
                        ->groupBy('y_menu_id')
                        ->orderBy('y_role_menu.id')->all();

                    $i = 0;
                    foreach ($roleMenus as $k => $v) {
                        if (is_null($v->yMenu->parent_id)) continue;
                        $parent[$i] = $v->yMenu->parent->attributes;
                        $i++;
                    }
                    foreach ($roleMenus as $k => $v) {
                        $menus[$k] = $v->yMenu->attributes;
                    }
                    $unique = array_unique(array_column($parent, 'id'));
                    $parent = array_intersect_key($parent, $unique);
                    $menus = array_merge($menus, $parent);
                }

                $menus = ArrayHelper::index($menus, null, 'parent_id');

                $i = 1;
                $menuItems[0] = ['label' => 'MAIN MENU', 'header' => true];
                if (isset($menus[''])) {
                    foreach ($menus[''] as $key => $v) {
                        $items = [];
                        if (isset($menus[$v['id']])) {
                            foreach ($menus[$v['id']] as $k => $menu) {
                                $items[$k] =  ['label' => $menu['nama'], 'url' => [$menu['url']]];
                            }
                        }
                        $menuItems[$i] = [
                            'label' => $v['nama'], 'url' => [$v['url']], 'icon' => ($v['icon'] != '' ? $v['icon'] : null),
                            'items' => $items
                        ];
                        $i++;
                    }
                }

                $menuItems[$i++] = [
                    'label' => 'Sign Out',
                    'icon' => 'fas fa-sign-out-alt',
                    'url' => ['site/logout'],
                    'method' => 'post',
                    'visible' => !Yii::$app->user->isGuest,
                    'template' => '<a class="nav-link" href="{url}" data-method="post">{icon} {label}</a>'
                ];

                echo \app\widgets\Menu::widget([
                    // 'options' => ['id' => 'sidebarnav'],
                    'items' => $menuItems
                ]);
            }
            ?>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>