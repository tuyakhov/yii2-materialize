<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize';
    public $css = [
        YII_DEBUG ? 'css/materialize.css' : 'js/materialize.min.css',
    ];
}