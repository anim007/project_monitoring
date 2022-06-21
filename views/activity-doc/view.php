<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TActivityDoc */

$url = ['/project/view', 'id' => $model->t_project_id];

$this->title = 'Detail Dokumentasi ' . $model->t_activity_doc_id;
$this->params['breadcrumbs'][] = ['label' => 'List Dokumentasi', 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->t_activity_doc_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->t_activity_doc_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="tactivity-doc-view">

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="body table-responsive">
                                <?= DetailView::widget([
                                    'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                                    'model' => $model,
                                    'attributes' => [
                                        'tActivity.name:text:Activity Name',
                                        'tProject.name:text:Project Name',
                                        'description:ntext',
                                        'date:date',
                                        'created_at:datetime',
                                        'createdBy.username:text:Created By',
                                        'updated_at:datetime',
                                        'updatedBy.username:text:Updated By',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="col-sm-12 col-md-8">
                                <img src="<?= Yii::getAlias('@web/') . $model->file_path ?>" alt="image" class="img-thumbnail" width="100%">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>