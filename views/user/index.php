<?php

use app\components\ListComponent;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'List User');
$this->params['breadcrumbs'][] = $this->title;

$listStatusUser = ListComponent::getListStatusUser();
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="user-index">
                    <?php Pjax::begin(); ?>

                    <?= Html::a('<i class="fas fa-plus"></i> Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
                    <br><br>
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

                                'username',
                                // 'auth_key',
                                // 'password_hash',
                                // 'password_reset_token',
                                'email:email',
                                'created_at:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return ListComponent::getListStatusUser()[$model->status];
                                    },
                                    'filter' => $listStatusUser
                                ],
                                // 'updated_at',
                                // 'lastlogin_at:date',
                                // 'lastlogin_ip',

                                [
                                    'class' => 'app\widgets\ActionColumn',
                                    // 'headerOptions' => ['width' => '120'],
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