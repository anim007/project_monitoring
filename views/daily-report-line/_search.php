<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TDailyReportLineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tdaily-report-line-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 't_daily_report_line_id') ?>

    <?= $form->field($model, 't_daily_report_id') ?>

    <?= $form->field($model, 't_project_id') ?>

    <?= $form->field($model, 'labor_skill') ?>

    <?= $form->field($model, 'activity') ?>

    <?php // echo $form->field($model, 'material_type') ?>

    <?php // echo $form->field($model, 'tool_type') ?>

    <?php // echo $form->field($model, 'qty_1') ?>

    <?php // echo $form->field($model, 'qty_2') ?>

    <?php // echo $form->field($model, 'uom_1') ?>

    <?php // echo $form->field($model, 'uom_2') ?>

    <?php // echo $form->field($model, 'uom_3') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
