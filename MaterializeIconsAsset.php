<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\web\AssetBundle;

class MaterializeIconsAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';

    public $css = [
        'http://fonts.googleapis.com/icon?family=Material+Icons'
    ];
}