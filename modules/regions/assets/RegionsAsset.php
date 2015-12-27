<?php

namespace app\modules\regions\assets;

use yii\web\AssetBundle;

class RegionsAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/regions/web';
    public $css = [
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];
}