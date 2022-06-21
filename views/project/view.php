<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\apps\TProject */

$this->title = 'Detail Project ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'List Project', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$tabs = [
    0 => 'Overview',
    1 => 'Perencanaan',
    2 => 'Realisasi',
    3 => 'Laporan',
    4 => 'Dokumentasi'
];

?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <!-- <div class="card-header">
                <?= Html::a('<i class="fas fa-pencil-alt"></i> Update', ['update', 'id' => $model->m_project_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="far fa-trash-alt"></i> Delete', ['delete', 'id' => $model->m_project_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div> -->
        <div class="tproject-view">
            <div class="col-12">
                <div class="card card-<?= Yii::$app->params['cardOptions'] ?> card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <?php foreach ($tabs as $key => $tab) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $key == 0 ? 'active' : '' ?>" id="custom-tabs-four-<?= $tab ?>-tab" data-toggle="pill" href="#custom-tabs-four-<?= $tab ?>" role="tab" aria-controls="custom-tabs-four-<?= $tab ?>" aria-selected="true"><?= $tab ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <?php foreach ($tabs as $key => $tab) : ?>
                                <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="custom-tabs-four-<?= $tab ?>" role="tabpanel" aria-labelledby="custom-tabs-four-<?= $tab ?>-tab">
                                    <?= $this->render('_index-' . strtolower($tab), [
                                        'model' => $model,
                                        'searchModelPerencanaan' => $searchModelPerencanaan,
                                        'searchModelRealisasi' => $searchModelRealisasi,
                                        'dataProviderPerencanaan' => $dataProviderPerencanaan,
                                        'dataProviderRealisasi' => $dataProviderRealisasi,
                                        'searchModelLaporan' => $searchModelLaporan,
                                        'dataProviderLaporan' => $dataProviderLaporan,
                                        'searchModelDoc' => $searchModelDoc,
                                        'dataProviderDoc' => $dataProviderDoc,
                                    ]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </div>
</div>