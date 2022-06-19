<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReport */

$this->title = 'Update Daily Report: ' . date('d M Y', strtotime($model->date));
// $this->params['breadcrumbs'][] = ['label' => 'List Daily Report', 'url' => ['/project/view', 'id' => $model->t_project_id]];
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['view', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id]];
// $this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->t_daily_report_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdaily-report-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>