<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\web\AssetBundle;

class YiiMaterializeAsset extends AssetBundle
{
    public $sourcePath = '@tuyakhov/materialize/assets';

    public $css = [
        'yii.materialize.css'
    ];
}