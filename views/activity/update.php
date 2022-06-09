<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivity */

$this->title = 'Update Activity : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $project->name . ' / ' . $model->name, 'url' => ['/project/view?id='.$model->t_project_id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="tactivity-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>