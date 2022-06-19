<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReport */

$this->title = 'Tambah Daily Report';
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdaily-report-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>