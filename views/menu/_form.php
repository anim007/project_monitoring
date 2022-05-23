<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YMenu */
/* @var $form yii\widgets\ActiveForm */

$listParent = ListComponent::getListParentMenu();
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="ymenu-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'aktif')->checkbox() ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'parent_id')->dropDownList($listParent, ['prompt' => '-- PILIH PARENT --']) ?>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="card-footer">
                    <div class="form-actions text-right">
                        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>