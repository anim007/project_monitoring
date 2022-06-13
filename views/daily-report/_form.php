<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReport */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="tdaily-report-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 't_project_id')->dropdownList(ListComponent::getListProject(), ['disabled' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <?= $form->field($model, 'date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                                </div>
                                <div class="col-3">
                                    <?= $form->field($model, 'work_hour_1')->textInput(['maxlength' => true]); ?>
                                </div>
                                <div class="col-3">
                                    <?= $form->field($model, 'work_hour_2')->textInput(['maxlength' => true]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'file_path')->fileInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <?= $form->field($model, 'weather_1')->dropdownList(ListComponent::getListWeather()) ?>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <?= $form->field($model, 'weather_2')->dropdownList(ListComponent::getListWeather()) ?>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <?= $form->field($model, 'weather_3')->dropdownList(ListComponent::getListWeather()) ?>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <?= $form->field($model, 'weather_4')->dropdownList(ListComponent::getListWeather()) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
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