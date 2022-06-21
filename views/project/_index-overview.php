<?php

use app\components\ListComponent;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */
/* @var $form yii\bootstrap4\ActiveForm */

$listPIC = ListComponent::getListBPartner('employee');
$listVendor = ListComponent::getListBPartner('vendor');
?>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="body table-responsive">
            <?= DetailView::widget([
                'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                'model' => $model,
                'attributes' => [
                    'mBpartner.first_name:text:Vendor',
                    'pic.first_name:text:PIC',
                    'start_date:date',
                    'finish_date:date',
                    [
                        'label' => 'Status',
                        'value' => function ($model) {
                            return \app\components\ListComponent::getListProjectStatus()[$model->status];
                        }
                    ],
                    [
                        'label' => 'Progress',
                        'value' => function ($model) {
                            return $model->getProgress() . ' %';
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="body table-responsive">
            <?= DetailView::widget([
                'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                'model' => $model,
                'attributes' => [
                    'created_at:datetime',
                    'createdBy.username:text:Created By',
                    'updated_at:datetime',
                    'updatedBy.username:text:Updated By'
                ],
            ]) ?>
        </div>
    </div>
</div>