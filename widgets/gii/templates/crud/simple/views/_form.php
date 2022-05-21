<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$notGeneratedField = ['created_at', 'created_by', 'updated_at', 'updated_by'];

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card <?= "<?= " ?>Yii::$app->params['cardOptions']<?= " ?>" ?>">
            <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
                <?= "<?php " ?>$form = ActiveForm::begin(); ?>
                <div class="card-header">
                    <h3 class="card-title">Form <?= "<?= " ?>$this->title<?= " ?>" ?></h3>
                </div>
                <div class="card-body">
                    <?php foreach ($generator->getColumnNames() as $attribute) {
                        if (in_array($attribute, $safeAttributes) && !in_array($attribute, $notGeneratedField)) {
                            echo "                    <?= " . $generator->generateActiveField($attribute) . " ?>\n";
                        }
                    } ?>
                </div>
                <div class="card-footer">
                    <div class="form-actions text-right">
                        <?= "<?= " ?>Html::submitButton(<?= "'" . '<i class="fas fa-save"></i> Simpan' . "'" ?>, ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?= "<?php " ?>ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>