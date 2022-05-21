<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

$notGeneratedField = ['created_at', 'created_by', 'updated_at', 'updated_by'];
$title = Inflector::camel2words(StringHelper::basename($generator->modelClass));

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::camel2words('List ' . $title)) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= "<?= " ?>Html::a(<?= "'" . '<i class="fas fa-plus"></i> Tambah ' . $title . "'" ?>, ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
                    <?= $generator->enablePjax ? "<?php Pjax::begin(); ?>\n" : '' ?>
                    <div class="body table-responsive">
                    <?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "                    <?= " ?>GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table table-sm table-hover text-nowrap'],
        <?= !empty($generator->searchModelClass) ? "                    'filterModel' => \$searchModel,\n                            'columns' => [\n" : "'columns' => [\n"; ?>
                                ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count == 1 || in_array($name, $notGeneratedField)) continue;
        if (++$count < 15 && ($name != 'id' || strpos($name, '_id') !== false) && !in_array($name, $notGeneratedField)) {
            if ($column->name === 'aktif')
                echo "                                '" . $name . ":boolean" . "',\n";
            else {
                echo "                                '" . $name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        } else {
            if ($column->name === 'aktif')
                echo "                                //'" . $name . ":boolean" . "',\n";
            else {
                echo "                                //'" . $name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count == 1) continue;
        if (++$count < 15 && ($column->name != 'id' || strpos($column->name, '_id') !== false) && !in_array($column->name, $notGeneratedField)) {
            if ($column->name === 'aktif')
                echo "                                '" . $column->name . ":boolean" . "',\n";
            else {
                echo "                                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        } else {
            if ($column->name === 'aktif')
                echo "                                //'" . $column->name . ":boolean" . "',\n";
            else {
                echo "                                //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
}
?>

                                [
                                    'class' => 'app\widgets\ActionColumn',
                                    'headerOptions' => ['width' => '100'],
                                ],
                            ],
                        ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
                    </div>
                    <?= $generator->enablePjax ? "<?php Pjax::end(); ?>\n" : '' ?>
                </div>
            </div>
        </div>
    </div>
</div>