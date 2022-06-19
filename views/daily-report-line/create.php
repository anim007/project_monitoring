<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */

$this->title = 'Tambah Daily Report Line';
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['/project/view?id='.$model->t_project_id]];
$this->params['breadcrumbs'][] = ['label' => date('d M Y', strtotime($dailyreport->date)), 'url' => ['/daily-report/view?id='.$model->t_daily_report_id, 'project_id' => $model->t_project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdaily-report-line-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>