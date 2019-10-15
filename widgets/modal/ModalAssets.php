<?php

namespace app\widgets\modal;

use yii\web\AssetBundle;

class ModalAssets extends AssetBundle
{
    public $sourcePath = '@app/widgets/modal/assets';

    public $css = [
        'css/modal.css'
    ];
    public $js = [
        'js/modal.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}