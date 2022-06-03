<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

class WidgetComponent extends \yii\base\Component
{
    public static function datePickerConfig()
    {
        return [
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ];
    }

    public static function select2ModelConfig($data, $placeholder = '')
    {
        return [
            'data' => $data,
            'options' => ['placeholder' => '-- ' . $placeholder . ' --'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ];
    }
}
