<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\YRole */

$this->title = Yii::t('app', 'Tambah Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'List Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yrole-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>