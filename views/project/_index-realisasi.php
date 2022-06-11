<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="realisasi-index">
    <?php \yii\widgets\Pjax::begin(); ?>

    <?php echo $this->render('_search-realisasi', ['model' => $searchModelRealisasi, 'pid' => $model->m_project_id]); ?>
    <hr class="mt-0"/>

    <div class="body table-responsive">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderRealisasi,
            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
            // 'filterModel' => $searchModelRealisasi,
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
                'finish_date:date',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return ListComponent::getListActivityStatus()[$model->status];
                    }
                ],

                [
                    'class' => 'app\widgets\ActionColumn',
                    'headerOptions' => ['width' => '100'],
                    'template' => '{view}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['/activity/view', 'id' => $model->t_activity_id]);
                            return $url;
                        }
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>