<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row mb-2">
    <div class="col-12">
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Laporan', ['/daily-report/create', 'project_id' => $model->m_project_id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<div class="laporan-index">
    <?php echo $this->render('_search-laporan', ['model' => $searchModelLaporan, 'project_id' => $model->m_project_id]);
    ?>
    <hr class="mt-0"/>

    <?php \yii\widgets\Pjax::begin(); ?>
    <div class="body table-responsive">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderLaporan,
            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
            // 'filterModel' => $searchModelLaporan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'date:date',
                // 'file_path:ntext',
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
                //'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',

                [
                    'class' => 'app\widgets\ActionColumn',
                    'headerOptions' => ['width' => '100'],
                    'template' => '{view} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['/daily-report/view', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = Url::to(['/daily-report/update', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = Url::to(['/daily-report/delete', 'id' => $model->t_daily_report_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>