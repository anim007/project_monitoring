<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YMenu */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Menu',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'List Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ymenu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>