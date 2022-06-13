<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReport */

$this->title = 'Update Daily Report: ' . $model->t_daily_report_id;
$this->params['breadcrumbs'][] = ['label' => 'List Daily Report', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->t_daily_report_id, 'url' => ['view', 'id' => $model->t_daily_report_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tdaily-report-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>