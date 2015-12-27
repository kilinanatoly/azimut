<?php

namespace app\modules\Tree\assets;

use yii\web\AssetBundle;

class TreeAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/Tree/web';
    public $css = [
        'css/style.css',
        'css/site.css',
    ];
    public $js = [
        'js/script1.js',
        'js/enhance.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];
}