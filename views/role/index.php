<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\YRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'List Role');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-plus"></i> Tambah Role', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <div class="ymenu-index">
                    <?php Pjax::begin(); ?>

                    <div class="body table-responsive table-stats order-table ov-h">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); 
                        ?>
                        <?= GridView::widget([
                            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            // 'layout' => "{items}\n<div class='col-md-5'>{summary}</div>\n{pager}",
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'nama',
                                'deskripsi',
                                'role_aktif:boolean',
                                [
                                    'class' => 'app\widgets\ActionColumn',
                                    'headerOptions' => ['width' => '140'],
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