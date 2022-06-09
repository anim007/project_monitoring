<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Activity';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-plus"></i> Tambah Activity', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <div class="tactivity-index">
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
                                'name',
                                'descripiton:ntext',
                                'heaviness',
                                'start_date',
                                'est_finish_date',
                                'finish_date',
                                'status',
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