<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TDailyReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tdaily-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 't_daily_report_id') ?>

    <?= $form->field($model, 't_project_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'file_path') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'work_hour_1') ?>

    <?php // echo $form->field($model, 'work_hour_2') ?>

    <?php // echo $form->field($model, 'weather_1') ?>

    <?php // echo $form->field($model, 'weather_2') ?>

    <?php // echo $form->field($model, 'weather_3') ?>

    <?php // echo $form->field($model, 'weather_4') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updaed_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
