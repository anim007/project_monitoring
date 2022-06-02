<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MBpartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List ' . ucfirst($type);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?php if($type == 'vendor'){ ?>
                    <?= Html::a('<i class="fas fa-plus"></i> Tambah Vendor', ['create', 'type' => $searchModel->type], ['class' => 'btn btn-success']) ?>
                <?php } else if ($type == 'employee'){ ?>
                    <?= Html::a('<i class="fas fa-plus"></i> Tambah Employee', ['create', 'type' => $searchModel->type], ['class' => 'btn btn-success']) ?>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="mbpartner-index">
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
                                'first_name',
                                [
                                    'attribute' => 'last_name',
                                    'visible' => ($searchModel->type == 'employee'),
                                ],
                                [
                                    'attribute' => 'birth_date',
                                    'visible' => ($searchModel->type == 'employee'),
                                    'format' => 'date',
                                    'filter' => \kartik\date\DatePicker::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'birth_date',
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ])
                                ],
                                // 'address:ntext',
                                'phone',
                                // [
                                //     'attribute' => 'type',
                                //     'value' => function($model) {
                                //         return ListComponent::getListPartnerType()[$model->type];
                                //     },
                                //     'filter' => ListComponent::getListPartnerType()
                                // ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return ListComponent::getListDataStatus()[$model->status];
                                    },
                                    'filter' => ListComponent::getListDataStatus()
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