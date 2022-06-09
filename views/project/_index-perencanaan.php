<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row mb-2">
    <div class="col-12">
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Activity', ['/activity/create', 'project_id' => $model->m_project_id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<div class="perencanaan-index">
    <?php \yii\widgets\Pjax::begin(); ?>
    <div class="body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderPerencanaan,
            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
            'filterModel' => $searchModelActivity,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        return ListComponent::getListActivityType()[$model->type];
                    }
                ],
                'descripiton:ntext',
                'heaviness',
                'start_date:date',
                'est_finish_date:date',
                // 'finish_date',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return ListComponent::getListActivityStatus()[$model->status];
                    }
                ],
                //'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',

                [
                    'class' => 'app\widgets\ActionColumn',
                    'headerOptions' => ['width' => '100'],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['/activity/view', 'id' => $model->t_activity_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = Url::to(['/activity/update', 'id' => $model->t_activity_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = Url::to(['/activity/delete', 'id' => $model->t_activity_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>