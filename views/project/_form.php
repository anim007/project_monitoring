<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */
/* @var $form yii\bootstrap4\ActiveForm */

$listPIC = ListComponent::getListBPartner('employee');
$listVendor = ListComponent::getListBPartner('vendor');

$user           = Yii::$app->user;
$isPelaksana    = $user->isGuest ? false : array_search('Pelaksana', $user->identity->roles);
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="tproject-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'm_bpartner_id')->widget(Select2::class, WidgetComponent::select2ModelConfig($listVendor, 'PILIH VENDOR')) ?>
                        </div>
                        <?php if ($isPelaksana !== false) : ?>
                            <div class="col-sm-12 col-md-6">
                                <?= $form->field($model, 'pic_id')->dropdownList($listPIC, ['disabled' => true]) ?>
                            </div>
                        <?php else : ?>
                            <div class="col-sm-12 col-md-6">
                                <?= $form->field($model, 'pic_id')->widget(Select2::class, WidgetComponent::select2ModelConfig($listPIC, 'PILIH PIC')) ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'start_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'finish_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'status')->dropdownList(ListComponent::getListProjectStatus()) ?>
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