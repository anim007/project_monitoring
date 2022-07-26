<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row mb-2">
    <div class="col-12">
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Dokumentasi', ['/activity-doc/create', 'project_id' => $model->m_project_id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<div class="dokumentasi-index">

    <?php \yii\widgets\Pjax::begin(); ?>
    
    <?php echo $this->render('_search-dokumentasi', ['model' => $searchModelDoc, 'pid' => $model->m_project_id]); ?>
    <hr class="mt-0" />

    <div class="body table-responsive">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderDoc,
            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
            // 'filterModel' => $searchModelLaporan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // [
                //     'attribute' => 't_project_id',
                //     'value' => function ($model) {
                //         return $model->tProject->name;
                //     }
                // ],
                'date:date',
                // 'file_path:ntext',
                'description:ntext',
                'is_verified:boolean',
                [
                    'class' => 'app\widgets\ActionColumn',
                    'headerOptions' => ['width' => '100'],
                    'template' => '{view} {update} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['/activity-doc/view', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = Url::to(['/activity-doc/update', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = Url::to(['/activity-doc/delete', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>