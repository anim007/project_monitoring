<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */

$this->title = 'Update Daily Report Line: ' . $project->name;
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['/daily-report/view?id='.$model->t_daily_report_id, 'project_id' => $model->t_project_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdaily-report-line-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>