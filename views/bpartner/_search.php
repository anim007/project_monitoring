<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MBpartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mbpartner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index', 'type' => $model->type],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
        ],
    ]); ?>

    <div class="row clearfix">
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'value') ?>
        </div>
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <?php if($model->type == 'employee') { ?>
            <div class="col-sm-12 col-md-2">
                <?= $form->field($model, 'last_name') ?>
            </div>

            <div class="col-sm-12 col-md-2">
                <?= $form->field($model, 'birth_date')->widget(\kartik\date\DatePicker::class, [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]) ?>
            </div>
        <?php } ?>
        
        <div class="col-sm-12 col-md-2">
            <?= $form->field($model, 'status')->dropDownList(ListComponent::getListDataStatus(), [
                'prompt' => 'SEMUA'
            ]) ?>
        </div>

        <div class="col-sm-12 col-md-2">
            <label for="button">&nbsp;</label>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', ['index', 'type' => $model->type], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>