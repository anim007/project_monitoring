<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\MBpartner */

$this->title = 'Tambah Vendor';
$this->params['breadcrumbs'][] = ['label' => 'List Vendor', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbpartner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>