<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivityDoc */

$url = ['/project/view', 'id' => $model->t_project_id];

$this->title = 'Update Dokumentasi: ' . $model->t_activity_doc_id;
$this->params['breadcrumbs'][] = ['label' => 'List Dokumentasi', 'url' => $url];
$this->params['breadcrumbs'][] = ['label' => $model->t_activity_doc_id, 'url' => ['view', 'id' => $model->t_activity_doc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tactivity-doc-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>