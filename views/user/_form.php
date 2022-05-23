<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\apps\YUserRole;
use mdm\widgets\GridInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="yuser-form">
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'username')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                    <?= $form->field($model, 'aktif')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="yrole-form">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Role User</h3>
                </div>
                <div class="card-body">
                    <?=
                    GridInput::widget([
                        'id' => 'tbl-menu',
                        'allModels' => $model->yUserRoles,
                        'model' => YUserRole::className(),
                        'form' => $form,
                        'columns' => [
                            ['class' => 'mdm\widgets\SerialColumn'],
                            [
                                'attribute' => 'y_role_id',
                                'items' => \app\components\ListComponent::getListRole(),
                            ],
                            ['class' => 'app\widgets\ButtonColumn']
                        ],
                        'hiddens' => [
                            'y_user_role_id',
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