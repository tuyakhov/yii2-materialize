<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;
use yii\widgets\InputWidget;

class Select extends InputWidget
{
    use WidgetTrait;

    public $items = [];

    public function run()
    {
        $this->registerPlugin('material_select');
        if ($this->hasModel()) {
            return Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        } else {
            return Html::dropDownList($this->name, $this->value, $this->items, $this->options);
        }
    }
}