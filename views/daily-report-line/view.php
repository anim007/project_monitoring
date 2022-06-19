<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReportLine */

$this->title = 'Detail Daily Report Line ' . $model->labor_skill;
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['/project/view?id='.$model->t_project_id]];
$this->params['breadcrumbs'][] = ['label' => date('d M Y', strtotime($dailyreport->date)), 'url' => ['/daily-report/view?id='.$model->t_daily_report_id, 'project_id' => $model->t_project_id]];
$this->params['breadcrumbs'][] = $model->labor_skill;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->t_daily_report_line_id, 'project_id' => $model->t_project_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->t_daily_report_line_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="tdaily-report-line-view">
                    <div class="body table-responsive">
                        <?= DetailView::widget([
                            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                            'model' => $model,
                            'attributes' => [
                                // 't_daily_report_line_id',
                                't_daily_report_id',
                                't_project_id',
                                'labor_skill',
                                'activity',
                                'material_type',
                                'tool_type',
                                'qty_1',
                                'qty_2',
                                'uom_1',
                                'uom_2',
                                'uom_3',
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