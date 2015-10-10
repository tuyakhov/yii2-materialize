<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class DatePicker extends InputWidget
{
    use WidgetTrait;

    public function run()
    {
        if (!isset($this->clientOptions['container'])) {
            $this->clientOptions['container'] = 'body';
        }
        $this->registerJqueryPlugin('pickadate');
        Html::addCssClass($this->options, 'datepicker');
        if ($this->hasModel()) {
            $this->options['data-value'] = isset($this->value) ? $this->value : Html::getAttributeValue($this->model, $this->attribute);
            return Html::activeInput('date', $this->model, $this->attribute, $this->options);
        } else {
            $this->options['data-value'] = $this->value;
            return Html::input('date', $this->name, $this->value, $this->options);
        }
    }
}