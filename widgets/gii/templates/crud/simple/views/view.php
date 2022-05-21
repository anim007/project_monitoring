<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$title = Inflector::camel2words(StringHelper::basename($generator->modelClass));

if (strpos($title, 'Ms ') !== false) $title = str_replace('Ms ', '', $title);
else if (strpos($title, 'Tr ') !== false) $title = str_replace('Tr ', '', $title);

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Detail ' . $title . ' ') ?> . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString('List ' . $title) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <?= "<?= " ?>Html::a(<?= "'" . '<i class="fas fa-pencil-alt"></i> Update' . "'" ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
                <?= "<?= " ?>Html::a(<?= "'" . '<i class="far fa-trash-alt"></i> Delete' . "'" ?>, ['delete', <?= $urlParams ?>], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="card-body">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
                    <div class="body table-responsive">
                        <?= "<?= " ?>DetailView::widget([
                            'options' => ['class' => 'table table-sm table-striped table-bordered detail-view'],
                            'model' => $model,
                            'attributes' => [
                        <?php
                        if (($tableSchema = $generator->getTableSchema()) === false) {
                            foreach ($generator->getColumnNames() as $name) {
                                echo "        '" . $name . "',\n                        ";
                            }
                        } else {
                            foreach ($generator->getTableSchema()->columns as $column) {
                                $format = stripos($column->name, 'is_aktif') !== false ? 'boolean' : $generator->generateColumnFormat($column);
                                $format = stripos($column->name, 'created_at') !== false || stripos($column->name, 'updated_at') !== false ? 'datetime' : $generator->generateColumnFormat($column);
                                echo "        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n                        ";
                            }
                        }
                        ?>
    ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>