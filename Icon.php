<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;

class Icon extends Widget
{
    /**
     * @var string prefix for icon name
     */
    public $iconPrefix = 'mdi-';
    /**
     * @var string the tag to use to render the icon
     */
    public $tagName = 'i';
    /**
     * @var string the icon name
     */
    public $name;
    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        Html::addCssClass($this->options, $this->iconPrefix . $this->name);
    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        return Html::tag($this->tagName, '', $this->options);
    }
}