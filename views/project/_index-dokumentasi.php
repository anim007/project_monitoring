<?php

use app\components\ListComponent;
use yii\helpers\Html;
use yii\helpers\Url;

$user       = Yii::$app->user;
$curRole    = '';
$roleMenus  = \app\models\apps\YRoleMenu::find()->where(['in', 'y_role_id', $user->identity->yRoleIDs])->orderBy('y_menu_id')->all();
foreach ($roleMenus as $k => $v) {
    $curRole = '"' . $v->yRole->nama . '"';
}

?>

<div class="row mb-2">
    <div class="col-12">
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Dokumentasi', ['/activity-doc/create', 'project_id' => $model->m_project_id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<div class="dokumentasi-index">

    <?php \yii\widgets\Pjax::begin(); ?>
    
    <?php echo $this->render('_search-dokumentasi', ['model' => $searchModelDoc, 'pid' => $model->m_project_id]); ?>
    <hr class="mt-0" />

    <div class="body table-responsive">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderDoc,
            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
            // 'filterModel' => $searchModelLaporan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'date:date',
                'description:ntext',
                'is_verified:boolean',
                [
                    'class' => 'app\widgets\ActionColumn',
                    'headerOptions' => ['width' => '100'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<button id="edit-doc" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></button>', $url, [
                                'title' => 'Update',
                            ]);
                        },
                    ],
                     'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['/activity-doc/view', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = Url::to(['/activity-doc/update', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = Url::to(['/activity-doc/delete', 'id' => $model->t_activity_doc_id, 'project_id' => $model->t_project_id]);
                            return $url;
                        }
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>

<?php 
$js=<<< JS
console.log('cbValid');
    let btnEdits = $("#edit-doc");
    
    setTimeout(function() {        
        if ($curRole === "Manager") {
            btnEdits.show();
        }
    }, 500);
    
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>