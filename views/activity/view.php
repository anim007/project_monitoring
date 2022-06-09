<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivity */

$this->title = 'Detail Activity ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'List Activity', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->t_activity_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->t_activity_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="tactivity-view">
                    <div class="body table-responsive">
                        <?= DetailView::widget([
                            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                            'model' => $model,
                            'attributes' => [
                                't_activity_id',
                                't_project_id',
                                'name',
                                'descripiton:ntext',
                                'heaviness',
                                'start_date',
                                'est_finish_date',
                                'finish_date',
                                'status',
                                'created_at:datetime',
                                'created_by',
                                'updated_at:datetime',
                                'updated_by',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>