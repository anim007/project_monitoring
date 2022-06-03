<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TProjectSearch */
/* @var $form yii\widgets\ActiveForm */

$listPIC = ListComponent::getListBPartner('employee');
$listVendor = ListComponent::getListBPartner('vendor');
?>

<div class="tproject-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row clearfix">
        <!-- <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'value') ?>
        </div> -->
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'm_bpartner_id')->widget(Select2::class, WidgetComponent::select2ModelConfig($listVendor, 'PILIH VENDOR')) ?>
        </div>
        <!-- <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'pic_id')->widget(Select2::class, WidgetComponent::select2ModelConfig($listPIC, 'PILIH PIC')) ?>
        </div> -->
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'start_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'finish_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'status')->dropDownList(ListComponent::getListProjectStatus(), [
                'prompt' => 'SEMUA'
            ]) ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <label for="button">&nbsp;</label>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>