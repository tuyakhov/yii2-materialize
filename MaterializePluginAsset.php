<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\web\AssetBundle;

class MaterializePluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize';
    public $js = [
        YII_DEBUG ? 'js/materialize.js' : 'js/materialize.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'tuyakhov\materialize\Materialize'
    ];
}