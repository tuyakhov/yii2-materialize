<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
    /**
     * @inheritdoc
     */
    public $template = "{icon}\n{input}\n{label}\n{hint}\n{error}";

    /**
     * @inheritdoc
     */
    public $options = ['class' => 'input-field'];

    /**
     * @inheritdoc
     */
    public $inputOptions = ['class' => 'validate'];

    /**
     * @var array
     */
    public $iconOptions = ['class' => 'prefix'];

    /**
     * @var string
     */
    public $radioGapCssClass = 'with-gap';

    /**
     * @var string
     */
    public $checkboxFilledCssClass = 'filled-in';

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function textarea($options = [])
    {
        Html::addCssClass($options, 'materialize-textarea');
        return parent::textarea($options);
    }

    /**
     * Renders default browser drop-down list
     * @see http://materializecss.com/forms.html#select
     * @param $items
     * @param array $options
     * @return $this
     */
    public function dropDownListDefault($items, $options = [])
    {
        Html::addCssClass($options, 'browser-default');
        return parent::dropDownList($items, $options);
    }

    /**
     * @inheritdoc
     */
    public function dropDownList($items, $options = [])
    {
        return $this->widget(Select::className(), [
            'items' => $items,
            'options' => $options
        ]);
    }

    /**
     * Creates radio button with gap
     * @see http://materializecss.com/forms.html#radio
     * @param array $options
     * @param bool|true $enclosedByLabel
     * @return $this
     */
    public function radioWithGap($options = [], $enclosedByLabel = true)
    {
        Html::addCssClass($options, $this->radioGapCssClass);
        return self::radio($options, $enclosedByLabel);
    }

    /**
     * Renders a list of radio buttons with gap
     * @param $items
     * @param array $options
     * @return $this|ActiveField
     */
    public function radioListWithGap($items, $options = [])
    {
        $this->addListInputCssClass($options, $this->radioGapCssClass);
        return self::radioList($items, $options);
    }

    /**
     * Renders filled in checkbox
     * @see http://materializecss.com/forms.html#checkbox
     * @param array $options
     * @param bool|true $enclosedByLabel
     * @return $this
     */
    public function checkboxFilled($options = [], $enclosedByLabel = true)
    {
        Html::addCssClass($options, $this->checkboxFilledCssClass);
        return parent::checkbox($options, $enclosedByLabel);
    }

    /**
     * Renders switcher
     * @see http://materializecss.com/forms.html#switches
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

    /**
     * Renders a list of filled checkboxes
     * @param $items
     * @param array $options
     * @return $this|ActiveField
     */
    public function checkboxListFilled($items, $options = [])
    {
        $this->addListInputCssClass($options, $this->checkboxFilledCssClass);
        return self::checkboxList($items, $options);
    }

    /**
     * @inheritdoc
     */
    public function checkboxList($items, $options = [])
    {
        $this->parts['{label}'] = '';
        $this->parts['{input}'] = \tuyakhov\materialize\Html::activeCheckboxList($this->model, $this->attribute, $items, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function radioList($items, $options = [])
    {
        $this->parts['{label}'] = '';
        $this->parts['{input}'] = \tuyakhov\materialize\Html::activeRadioList($this->model, $this->attribute, $items, $options);

        return $this;
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