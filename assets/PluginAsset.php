<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main plugin asset bundle.
 *
 * @author Anim Falahuddin
 * @since 2.0
 */
class PluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'overlayScrollbars/css/OverlayScrollbars.min.css',
        'toastr/toastr.min.css',
    ];
    public $js = [
        'overlayScrollbars/js/OverlayScrollbars.min.js',
        'toastr/toastr.min.js',
    ];
}
