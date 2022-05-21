<?php
namespace common\widgets;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\helpers\Html;

class CustomField extends ActiveField
{
    public function init()
    {
        $position = ArrayHelper::remove($this->options, 'right');
        $icon = ArrayHelper::getValue($this->options, 'icon', '');

        $this->template =
            '<div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">' . $icon . '</i>
                </span>
                <div class="form-line">{input}</div>
                {error}{hint}
                </div>';


        parent::init();
    }

    public function textInput($options = [])
    {
        if (empty($options['placeholder'])) {
            $options['placeholder'] = $this->model->getAttributeLabel($this->attribute);
        }
        return parent::textInput($options);
    }

    public function passwordInput($options = [])
    {
        if (empty($options['placeholder'])) {
            $options['placeholder'] = $this->model->getAttributeLabel($this->attribute);
        }
        return parent::passwordInput($options);
    }

    // public function checkbox($options = [], $enclosedByLabel = true)
    // {
    //     $name = Html::getInputName($this->model, $this->attribute);

    //     // $this->parts['{input}'] = '<input type="checkbox" name="'.$name.'" id="'.$this->attribute.'" class="filled-in chk-col-pink">
    //     //                             <label for="'.$this->attribute.'">'.$this->model->getAttributeLabel($this->attribute).'</label>';

    //     // $this->parts['{input}'] = Html::activeCheckbox($this->model, $this->attribute, $options);
    //     // $this->parts['{label}'] = '';

    //     $this->template = "{input}{label}";
    //     $checkbox = parent::checkbox($options);
    //     return $checkbox;
    // }
}
