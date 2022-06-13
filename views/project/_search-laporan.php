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
        'action' => ['view', 'id' => $project_id],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row clearfix">
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
        </div>
        <div class="col-sm-12 col-md-4">
            <?= $form->field($model, 'description')->textInput() ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <label for="button">&nbsp;</label>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', ['view', 'id' => $project_id], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>