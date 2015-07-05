<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
    public $template = "{icon}\n{input}\n{label}\n{hint}\n{error}";

    public $options = ['class' => 'input-field'];

    public $inputOptions = ['class' => 'validate'];

    public $iconOptions = ['class' => 'prefix'];

    public $radioGapCssClass = 'with-gap';

    public $checkboxFilledCssClass = 'filled-in';

    public $labelOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->labelOptions['class']) && !empty($this->model->{$this->attribute})) {
            Html::addCssClass($this->labelOptions, 'active');
        }

        parent::init();
    }

    /**
     * @param null $content
     * @return string
     */
    public function render($content = null)
    {
        if ($content === null) {
            if (!isset($this->parts['{icon}'])) {
                $this->parts['{icon}'] = '';
            }
        }
        return parent::render($content);
    }

    /**
     * @param null $icon
     * @param array $options
     * @return $this
     */
    public function icon($icon, $options = [])
    {
        if ($icon === false) {
            $this->parts['{icon}'] = '';
            return $this;
        }

        $options = array_merge($this->iconOptions, $options);
        $this->parts['{icon}'] = Icon::widget(['name' => $icon, 'options' => $options]);

        return $this;
    }

    public function textarea($options = [])
    {
        Html::addCssClass($options, 'materialize-textarea');
        return parent::textarea($options);
    }

    public function dropDownListDefault($items, $options = [])
    {
        Html::addCssClass($options, 'browser-default');
        return parent::dropDownList($items, $options);
    }

    public function dropDownList($items, $options = [])
    {
        return $this->widget(Select::className(), [
            'items' => $items,
            'options' => $options
        ]);
    }

    public function radioWithGap($options = [], $enclosedByLabel = true)
    {
        Html::addCssClass($options, $this->radioGapCssClass);
        return parent::radio($options, $enclosedByLabel);
    }

    public function radioListWithGap($items, $options = [])
    {
        $this->addListInputCssClass($options, $this->radioGapCssClass);
        return parent::radioList($items, $options);
    }

    public function checkboxFilled($options = [], $enclosedByLabel = true)
    {
        Html::addCssClass($options, $this->checkboxFilledCssClass);
        return parent::checkbox($options, $enclosedByLabel);
    }

    /**
     * @param array $options
     * @param array $flags
     * @return $this
     */
    public function switcher($options = [], $flags = null)
    {
        parent::checkbox($options, false);
        if ($flags === null) {
            $label = Html::encode($this->model->getAttributeLabel(Html::getAttributeName($this->attribute)));
            $labelParts = explode(',', $label);
            $flags = count($labelParts) >= 2 ? $labelParts : null;
        }
        if ($flags) {
            Html::removeCssClass($this->options, 'input-field');
            Html::addCssClass($this->options, 'switch');
            $labelContent = $flags[0] . $this->parts['{input}'] . Html::tag('span', '', ['class' => 'lever']) . $flags[1];
            $this->parts['{input}'] = Html::label($labelContent, Html::getInputId($this->model, $this->attribute));
        }
        return $this;
    }

    public function checkboxListFilled($items, $options = [])
    {
        $this->addListInputCssClass($options, $this->checkboxFilledCssClass);
        return parent::checkboxList($items, $options);
    }

    protected function addListInputCssClass(&$options, $class)
    {
        if (!isset($options['itemOptions'])) {
            $options['itemOptions'] = ['class' => $class];
        } else {
            Html::addCssClass($options['itemOptions'], $class);
        }
    }


}