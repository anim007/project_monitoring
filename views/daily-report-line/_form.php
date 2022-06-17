<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="tdaily-report-line-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 't_project_id')->dropdownList(ListComponent::getListProject(), [
                                'readonly' => true
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'labor_skill')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'material_type')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'qty_1')->textInput() ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'activity')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'tool_type')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'qty_2')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'uom_1')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'uom_2')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'uom_3')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 'status')->dropdownList(ListComponent::getListDataStatus()) ?>
                        </div>
                    </div>
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