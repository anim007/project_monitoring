<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TDailyReport */

$this->title = 'Detail Daily Report ' . date('d M Y', strtotime($model->date));
$this->params['breadcrumbs'][] = ['label' => 'List Daily Report', 'url' => ['/project/view', 'id' => $model->t_project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="tdaily-report-view">
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <?= DetailView::widget([
                                    'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                                    'model' => $model,
                                    'attributes' => [
                                        // 't_daily_report_id',
                                        'tProject.name:text:Project Name',
                                        'date:date',
                                        'description:ntext',
                                        'work_hour_1',
                                        'work_hour_2',
                                        [
                                            'attribute' => 'weather_1',
                                            'value' => function ($model) {
                                                return ListComponent::getListWeather()[$model->weather_1];
                                            }
                                        ],
                                        [
                                            'attribute' => 'weather_2',
                                            'value' => function ($model) {
                                                return ListComponent::getListWeather()[$model->weather_2];
                                            }
                                        ],
                                        [
                                            'attribute' => 'weather_3',
                                            'value' => function ($model) {
                                                return ListComponent::getListWeather()[$model->weather_3];
                                            }
                                        ],
                                        [
                                            'attribute' => 'weather_4',
                                            'value' => function ($model) {
                                                return ListComponent::getListWeather()[$model->weather_4];
                                            }
                                        ],
                                        'created_at:datetime',
                                        'createdBy.username:text:Username',
                                        'updated_at:datetime',
                                        'updatedBy.username:text:Username',
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <img src="<?= Yii::getAlias('@web/') . $model->file_path ?>" alt="image" class="img-thumbnail" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="report-line">
                    <hr/>
                    <h3>Report Line</h3>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderLine,
                        'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
                        'filterModel' => $searchModelLine,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 't_daily_report_id',
                            // 't_project_id',
                            'activity',
                            'labor_skill',
                            'material_type',
                            'tool_type',
                            'qty_1',
                            'qty_2',
                            //'uom_1',
                            //'uom_2',
                            //'uom_3',
                            'status',
                            //'created_at',
                            //'created_by',
                            //'updated_at',
                            //'updated_by',

                            // [
                            //     'class' => 'app\widgets\ActionColumn',
                            //     'headerOptions' => ['width' => '100'],
                            // ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>