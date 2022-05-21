<?php
namespace common\widgets;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\helpers\Html;

class CustomFieldLabel extends ActiveField
{
    public function textInput($options = [])
    {
        $this->template =
            '<div class="form-group form-float">
                    <div class="form-line">
                        {input}
                        <label class="form-label">' . $this->model->getAttributeLabel($this->attribute) . '</label>
                    </div>
                {error}{hint}
                </div>';

        return parent::textInput($options);
    }

    public function textarea($options = [])
    {
        $this->template =
            '<div class="form-group form-float">
                    <div class="form-line">
                        {input}
                        <label class="form-label">' . $this->model->getAttributeLabel($this->attribute) . '</label>
                    </div>
                {error}{hint}
                </div>';

        return parent::textarea($options);
    }

    public function dropDownList($items, $options = [])
    {
        $this->template = '<div>{input}{error}{hint}</div>';

        return parent::dropDownList($items, $options);
    }

    public function checkbox($options = [], $enclosedByLabel = true)
    {
        $chekbox = parent::checkbox($options);
        $name = Html::getInputName($this->model, $this->attribute);
        $value = Html::getAttributeValue($this->model, $this->attribute);

        $this->template = '<div>{input}{label}{error}{hint}</div>';

        if (!array_key_exists('value', $options)) {
            $options['value'] = 'Y';
        }
        if (!array_key_exists('uncheck', $options)) {
            $options['uncheck'] = 'N';
        } elseif ($options['uncheck'] === false) {
            unset($options['uncheck']);
        }

        $checked = $value === $options['value'] || is_null($value) ? 'checked' : '';

        $value = array_key_exists('value', $options) ? $options['value'] : 'Y';
        if (isset($options['uncheck'])) {
            // add a hidden field so that if the checkbox is not selected, it still submits a value
            $hiddenOptions = [];
            if (isset($options['form'])) {
                $hiddenOptions['form'] = $options['form'];
            }
            $hidden = Html::hiddenInput($name, $options['uncheck'], $hiddenOptions);
            unset($options['uncheck']);
        } else {
            $hidden = '';
        }

        $this->parts['{input}'] = $hidden . '<input type="checkbox" name="' . $name . '" id="' . $this->attribute . '" class="filled-in" value="' . $value . '" ' . $checked . '/>';
        $this->parts['{label}'] = '<label for="' . $this->attribute . '">' . $this->model->getAttributeLabel($this->attribute) . '</label>';

        return $chekbox;
    }
}
