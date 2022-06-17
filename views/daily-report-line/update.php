<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */

$this->title = 'Update T Daily Report Line: ' . $model->t_daily_report_line_id;
$this->params['breadcrumbs'][] = ['label' => 'List T Daily Report Line', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->t_daily_report_line_id, 'url' => ['view', 'id' => $model->t_daily_report_line_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdaily-report-line-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>