<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TDailyReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Daily Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-plus"></i> Tambah Daily Report', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <div class="tdaily-report-index">
                    <?php Pjax::begin(); ?>
                    <div class="body table-responsive">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                't_project_id',
                                'date',
                                'file_path:ntext',
                                'description:ntext',
                                'work_hour_1',
                                'work_hour_2',
                                //'weather_1',
                                //'weather_2',
                                //'weather_3',
                                //'weather_4',
                                //'created_at',
                                //'created_by',
                                //'updated_at',
                                //'updated_by',

                                [
                                    'class' => 'app\widgets\ActionColumn',
                                    'headerOptions' => ['width' => '100'],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>