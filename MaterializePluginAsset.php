<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\web\AssetBundle;

class MaterializePluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $js = [
        'js/materialize.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'tuyakhov\materialize\MaterializeAsset'
    ];
}