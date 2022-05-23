<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\YMenu */

$this->title = Yii::t('app', 'Tambah Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'List Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ymenu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>