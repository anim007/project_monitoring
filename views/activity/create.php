<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivity */

$this->title = 'Tambah Activity';
$this->params['breadcrumbs'][] = ['label' => 'List Activity', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tactivity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>