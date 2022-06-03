<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */

$this->title = 'Update Project: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'List Project', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->m_project_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tproject-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>