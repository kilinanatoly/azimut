<?php

namespace app\modules\arenda\assets;

use yii\web\AssetBundle;

class arendaAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/arenda/web';
    public $css = [
        'css/style.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'

    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];
}