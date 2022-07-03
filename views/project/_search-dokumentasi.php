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
            <?= $form->field($model, 'date1')->widget(DatePicker::class, WidgetComponent::datePickerConfig())->label('Start Date') ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'date2')->widget(DatePicker::class, WidgetComponent::datePickerConfig())->label('End Date') ?>
        </div>
        <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'description')->textInput() ?>
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