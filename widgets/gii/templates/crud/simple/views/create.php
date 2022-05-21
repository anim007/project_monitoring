<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$title = Inflector::camel2words(StringHelper::basename($generator->modelClass));

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Tambah ' . $title) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString('List ' . $title) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>