<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YRole */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Role',
]) . $model->y_role_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'List Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->y_role_id, 'url' => ['view', 'id' => $model->y_role_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="yrole-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>