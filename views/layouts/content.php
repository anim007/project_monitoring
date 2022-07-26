<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;

// echo '<pre>';var_dump(isset(Yii::$app->controller->action->actionMethod)); echo '</pre>';  die();

$controller = Yii::$app->controller->id;
$cont       = '"' . $controller . '"';
$action     = '"' . (isset(Yii::$app->controller->action->actionMethod) ? Yii::$app->controller->action->actionMethod : null) . '"';
$user       = Yii::$app->user;
$isGuest    = $user->isGuest;
$readOnly   = 0;
$curRole    = '';
$roleMenus  = $isGuest ? '' : \app\models\apps\YRoleMenu::find()->where(['in', 'y_role_id', $user->identity->yRoleIDs])->orderBy('y_menu_id')->all();
foreach ($roleMenus as $k => $v) {
    $curRole = '"' . $v->yRole->nama . '"';
    if (strpos($v->yMenu->attributes['url'], $controller) !== false) {
        $readOnly = $v->is_readonly;
    }
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?= \app\widgets\Alert::widget(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php 
$js=<<< JS
    $(".toasts-top-right").animate({opacity: 1.0}, 3000).fadeOut("slow");
    setTimeout(() => {
        $(".toasts-top-right").remove(); 
    }, 3000);

    let btnAdd = $(".fa-plus");
    let btnEdit = $(".fa-pencil-alt");
    let btnDelete = $(".fa-trash-alt");

    let tabPerencanaan = $("#custom-tabs-four-Perencanaan-tab");

    if ($readOnly == 1) {
        btnAdd.parent().hide();
        btnEdit.parent().hide();
        btnDelete.parent().hide();

        if ($cont === "project" && $action === "actionIndex" && $curRole === "Admin") {
            btnDelete.parent().show();
            btnAdd.parent().show();
        }

        if ($cont === "project" && $action === "actionView" && $curRole === "Admin")
            tabPerencanaan.parent().hide();
    }
    // console.log();
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>