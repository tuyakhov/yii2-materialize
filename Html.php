<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\base\Widget;
use yii\helpers\BaseHtml;

class Html extends BaseHtml
{
    /**
     * @inheritdoc
     */
    public static function checkbox($name, $checked = false, $options = [])
    {
        if (!isset($options['id'])) {
            $options['id'] = Widget::$autoIdPrefix . Widget::$counter++;
        }
        $content = parent::checkbox($name, $checked, $options);
        if (isset($options['label'])) {
            $label = $options['label'];
            $for = $options['id'];
            $labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
            unset($options['label'], $options['labelOptions']);
            $content .= parent::label($label, $for, $labelOptions);
        }
        return $content;
    }

    /**
     * @inheritdoc
     */
    public static function checkboxList($name, $selection = null, $items = [], $options = [])
    {
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
        $inputId = isset($options['id']) ? $options['id'] : $name;
        $options['item'] = function ($index, $label, $name, $checked, $value) use ($itemOptions, $inputId) {
            $for = $inputId . '_' . $index;
            return parent::checkbox($name, $checked, array_merge($itemOptions, [
                'id' => $inputId,
                'value' => $value,
            ])) . parent::label($label, $for);
        };
        return parent::checkboxList($name, $selection, $items, $options);
    }

}