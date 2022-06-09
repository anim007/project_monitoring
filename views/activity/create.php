<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivity */

$this->title = 'Tambah Activity';
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['/project/view?id='.$model->t_project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tactivity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>