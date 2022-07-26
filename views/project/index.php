<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Project';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-plus"></i> Tambah Project', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <div class="tproject-index">
                    <?php Pjax::begin(); ?>

                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    <hr class="mt-0"/>

                    <div class="body table-responsive">

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'value',
                                'name',
                                // 'mBpartner.first_name',
                                // 'pic.first_name',
                                [
                                    'attribute' => 'm_bpartner_id',
                                    'value' => 'mBpartner.first_name',
                                ],
                                [
                                    'attribute' => 'pic_id',
                                    'value' => 'pic.first_name',
                                ],
                                'start_date:date',
                                'finish_date:date',
                                [
                                    'label' => 'Rest of Day',
                                    'value' => function($model) {
                                        $interval   = !is_null($model->finish_date) ? ' (' . $model->intervalOfFinishDate . ')' : '';
                                        return $interval;
                                    }
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return ListComponent::getListProjectStatus()[$model->status];
                                    }
                                ],
                                [
                                    'label' => 'Progress',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        $progress = $model->getProgress();
                                        return '<div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: '.$progress.'%;" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div>
                                        </div>';
                                    }
                                ],
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