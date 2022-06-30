<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivityDoc */

$url = ['/project/view', 'id' => $model->t_project_id];

$this->title = 'Tambah Dokumentasi';
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tactivity-doc-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>