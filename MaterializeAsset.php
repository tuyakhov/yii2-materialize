<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $css = [
        'css/materialize.css',
        'http://fonts.googleapis.com/icon?family=Material+Icons'
    ];

    public $depends = [
        'tuyakhov\materialize\YiiMaterializeAsset'
    ];
}