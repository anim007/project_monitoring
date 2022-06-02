<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\MBpartner */

$this->title = 'Detail Vendor ' . $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'List Vendor', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->m_bpartner_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->m_bpartner_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="mbpartner-view">
                    <div class="body table-responsive">
                        <?= DetailView::widget([
                            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                            'model' => $model,
                            'attributes' => [
                                'value',
                                'first_name',
                                [
                                    'label' => 'Last Name',
                                    'value' => $model->last_name,
                                    'visible' => ($model->type == 'employee')
                                ],
                                [
                                    'label' => 'Birth Date',
                                    'value' => $model->birth_date,
                                    'format' => 'date',
                                    'visible' => ($model->type == 'employee')
                                ],
                                'address:ntext',
                                'phone',
                                // [
                                //     'label' => 'Type',
                                //     'value' => function($model) {
                                //         return ListComponent::getListPartnerType()[$model->type];
                                //     }
                                // ],
                                [
                                    'label' => 'Active',
                                    'value' => function($model) {
                                        return ListComponent::getListDataStatus()[$model->status];
                                    }
                                ],
                                // 'created_at:datetime',
                                // 'created_by',
                                // 'updated_at:datetime',
                                // 'updated_by',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>