<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\MBpartner */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="mbpartner-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= ucfirst($model['type']) ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label(ucfirst($model['type']) . ' Code') ?>
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                            <?php if($model['type'] == 'employee'){ ?>
                            <?= $form->field($model, 'birth_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'type')->dropdownList(ListComponent::getListPartnerType(), [
                                'disabled' => true
                            ]) ?>
                            <?php if($model['type'] == 'employee'){ ?>
                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                            <?php } ?>
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model, 'status')->checkbox() ?>
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