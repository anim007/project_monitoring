<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\YRole */

$this->title = $model->y_role_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'List Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->y_role_id], ['class' => 'btn btn-primary waves-effect']) ?>
                <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->y_role_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="yrole-view">
                    <div class="body table-responsive no-padding">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'nama',
                                'deskripsi',
                                'role_aktif:boolean'
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>