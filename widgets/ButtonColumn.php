<?php

namespace app\widgets;

use mdm\widgets\Column;
use yii\helpers\Html;

/**
 * Description of ButtonColumn
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class ButtonColumn extends Column
{
    /**
     * @var string Icon for header
     */
    public $headerIcon = '<i class="fas fa-plus"></i>';
    /**
     * @var string Icon for delete button
     */
    public $deleteIcon = '<i class="far fa-trash-alt"></i>';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $id = $this->grid->options['id'] . '-add-button';
        $this->header = Html::a($this->headerIcon, '#', ['id' => $id, 'class' => 'btn btn-sm btn-success']);
        if (!isset($this->grid->clientOptions['btnAddSelector'])) {
            $this->grid->clientOptions['btnAddSelector'] = '#' . $id;
        }
        $this->value = Html::a($this->deleteIcon, '#', ['data-action' => 'delete', 'class' => 'btn btn-sm btn-danger']);
    }
}
