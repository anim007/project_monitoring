<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\apps\MBpartner */

$this->title = 'Update Vendor: ' . $model->m_bpartner_id;
$this->params['breadcrumbs'][] = ['label' => 'List Vendor', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->m_bpartner_id, 'url' => ['view', 'id' => $model->m_bpartner_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mbpartner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>