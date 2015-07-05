<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Html;

/**
 * Class Icon
 * @package tuyakhov\materialize
 * @see http://materializecss.com/icons.html
 */
class Icon extends Widget
{
    /**
     * @var string size of the icon (tiny, small, medium, large)
     */
    public $size = '';
    /**
     * @var string the tag to use to render the icon
     */
    public $tagName = 'i';
    /**
     * @var string the icon name
     * @see https://www.google.com/design/icons/
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
        MaterializeIconsAsset::register($this->getView());
        Html::addCssClass($this->options, $this->size);
        Html::addCssClass($this->options, 'material-icons');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        return Html::tag($this->tagName, $this->name, $this->options);
    }
}