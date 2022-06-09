<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivity */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="tactivity-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 't_project_id')->dropdownList(ListComponent::getListProject(), ['disabled' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'type')->dropdownList(ListComponent::getListActivityType()) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'heaviness')->textInput() ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'status')->dropdownList(ListComponent::getListActivityStatus()) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'descripiton')->textarea(['rows' => 2]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'start_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'est_finish_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <?= $form->field($model, 'finish_date', ['options' => ['style' => $model->status != 'finish' ? 'display: none;' : 'display: ;']])->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
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

<?php
$js = <<< JS
    $("#tactivity-status").change(function() {
        if($("#tactivity-status").val() != 'finish') {
            $(".field-tactivity-finish_date").attr('style', 'display: none;');
        } else {
            $(".field-tactivity-finish_date").attr('style', 'display: ;');
        }   
    });
JS;
$this->registerJs($js);
?>