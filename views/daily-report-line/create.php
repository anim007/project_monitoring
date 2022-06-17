<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */

$this->title = 'Tambah T Daily Report Line';
$this->params['breadcrumbs'][] = ['label' => 'List T Daily Report Line', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdaily-report-line-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>