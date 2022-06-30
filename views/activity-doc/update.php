<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivityDoc */

$url = ['/project/view', 'id' => $model->t_project_id];

$this->title = 'Update Dokumentasi : ' . $activity->name;
$this->params['breadcrumbs'][] = ['label' => $project->name . ' / ' . $activity->name, 'url' => $url];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tactivity-doc-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>