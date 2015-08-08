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
        $content = parent::checkbox($name, $checked, array_merge($options, ['label' => null]));
        if (isset($options['label'])) {
            $label = $options['label'];
            $for = $options['id'];
            $labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
            unset($options['label'], $options['labelOptions']);
            $content .= parent::label($label, $for, $labelOptions);
        }
        return $content;
    }

}