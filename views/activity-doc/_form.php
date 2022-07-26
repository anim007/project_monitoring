<?php

use app\components\ListComponent;
use app\components\WidgetComponent;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivityDoc */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= Yii::$app->params['cardOptions'] ?>">
            <div class="tactivity-doc-form">
                <?php $form = ActiveForm::begin(
                    ['options' => [['enctype' => 'multipart/form-data']]]
                ); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= $this->title ?></h3>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 't_activity_id')->dropdownList(ListComponent::getListActivity(null, $model->t_project_id)) ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'date')->widget(DatePicker::class, WidgetComponent::datePickerConfig()) ?>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <?= $form->field($model, 'file1')->fileInput() ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
                    
                    <?= $form->field($model, 'is_verified')->checkbox() ?>
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