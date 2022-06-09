<?php

use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin(); 
?>
<div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descripiton')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'heaviness')->textInput() ?>
    <?= $form->field($model, 'start_date')->textInput() ?>
    <?= $form->field($model, 'est_finish_date')->textInput() ?>
    <?= $form->field($model, 'finish_date')->textInput() ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
</div>
<?php ActiveForm::end(); ?>