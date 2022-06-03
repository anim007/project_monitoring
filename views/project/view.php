<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */

$this->title = 'Detail Project ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'List Project', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->m_project_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->m_project_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="tproject-view">
                    <div class="body table-responsive">
                        <?= DetailView::widget([
                            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                            'model' => $model,
                            'attributes' => [
                                'mBpartner.first_name:text:Vendor',
                                'pic.first_name:text:PIC',
                                'start_date:date',
                                'finish_date:date',
                                [
                                    'label' => 'status',
                                    'value' => function ($model) {
                                        return \app\components\ListComponent::getListProjectStatus()[$model->status];
                                    }
                                ],
                                'created_at:datetime',
                                'createdBy.username:text:Created By',
                                'updated_at:datetime',
                                'updatedBy.username:text:Updated By'
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>