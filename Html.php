<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\BaseHtml;

class Html extends BaseHtml
{
    /**
     * @inheritdoc
     */
    public static function checkboxList($name, $selection = null, $items = [], $options = [])
    {
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
        $inputId = isset($options['id']) ? $options['id'] : $name;
        $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $inputId) {
            $for = $inputId . '_' . $index;
            return Html::checkbox($name, $checked, array_merge($itemOptions, [
                'id' => $inputId,
                'value' => $value,
            ])) . Html::label($label, $for);
        };
        return parent::checkboxList($name, $selection, $items, $options);
    }

}