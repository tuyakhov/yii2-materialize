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
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        Html::addCssClass($this->options, 'btn');
        Waves::addWaveEffect($this->options, $this->waveColor, $this->waveFrom);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        return Html::tag($this->tagName, $this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
    }
}