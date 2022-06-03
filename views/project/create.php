<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */

$this->title = 'Tambah Project';
$this->params['breadcrumbs'][] = ['label' => 'List Project', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tproject-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>