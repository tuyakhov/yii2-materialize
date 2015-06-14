<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;

class Button extends Widget
{
    /**
     * @var string the tag to use to render the button
     */
    public $tagName = 'button';
    /**
     * @var bool button css class type
     * @see http://materializecss.com/buttons.html#flat
     */
    public $flat = false;
    /**
     * @var string the button label
     */
    public $label = 'Button';
    /**
     * @var boolean whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;
    /**
     * @var string wave effect color
     */
    public $waveColor = Waves::WAVE_LIGHT;
    /**
     * @var string|null optional wave effect form, default to ripple
     */
    public $waveFrom;
    /**
     * @var string|null
     */
    public $iconName;
    /**
     * @var string|null name-value pairs that will be used to initialize the Icon properties
     */
    public $iconConfig;

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        Html::addCssClass($this->options, $this->flat ? 'btn-flat' : 'btn');
        Waves::addWaveEffect($this->options, $this->waveColor, $this->waveFrom);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $content = '';
        if ($this->iconName !== null) {
            $this->iconConfig['name'] = $this->iconName;
            $content .= Icon::widget($this->iconConfig);
        }
        $content .= $this->encodeLabel ? Html::encode($this->label) : $this->label;
        return Html::tag($this->tagName, $content, $this->options);
    }
}