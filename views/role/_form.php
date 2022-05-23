<?php

use app\components\ListComponent;
use app\models\apps\YRoleMenu;
use mdm\widgets\GridInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\YRole */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="yrole-form">
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'role_aktif')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="ymenu-form">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Menu Role</h3>
                </div>
                <div class="card-body">
                <?=
                        GridInput::widget([
                            'id' => 'tbl-menu',
                            'options' => [
                                'class' => 'table table-sm table-striped',
                            ],
                            'allModels' => $model->yRoleMenus,
                            'model' => YRoleMenu::className(),
                            'form' => $form,
                            'columns' => [
                                ['class' => 'mdm\widgets\SerialColumn'],
                                [
                                    'attribute' => 'y_menu_id',
                                    'widget' => [
                                        Select2::className(),
                                        ['data' => ListComponent::getListMenu(),]
                                    ],
                                    'headerOptions' => ['width' => '60%'],
                                ],
                                [
                                    'attribute' => 'is_default',
                                    'items' => ['Tidak', 'Iya'],
                                    'headerOptions' => ['width' => '10%'],
                                ],
                                [
                                    'attribute' => 'is_tampil',
                                    'items' => [1 => 'Iya', 0 => 'Tidak'],
                                    'headerOptions' => ['width' => '10%'],
                                ],
                                ['class' => 'app\widgets\ButtonColumn']
                            ],
                            'hiddens' => [
                                'id',
                            ]
                        ])
                        ?>
                </div>
                <div class="card-footer">
                    <div class="form-actions text-right">
                        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>