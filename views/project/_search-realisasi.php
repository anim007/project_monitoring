<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perencanaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['view', 'id' => $pid],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row clearfix">
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'type')->dropDownList(ListComponent::getListActivityType(), [
                'prompt' => 'SEMUA'
            ]) ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'start_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'finish_date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'status')->dropDownList(ListComponent::getListActivityStatus(), [
                'prompt' => 'SEMUA'
            ]) ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <label for="button">&nbsp;</label>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', ['view?id=' . $pid], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>