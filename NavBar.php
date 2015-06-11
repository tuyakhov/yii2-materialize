<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NavBar extends Widget
{
    use WidgetTrait;
    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $containerOptions = [];
    /**
     * @var string|boolean the text of the brand of false if it's not used. Note that this is not HTML-encoded.
     */
    public $brandLabel = false;
    /**
     * @param array|string|boolean $url the URL for the brand's hyperlink tag. This parameter will be processed by [[Url::to()]]
     * and will be used for the "href" attribute of the brand link. Default value is false that means
     * [[\yii\web\Application::homeUrl]] will be used.
     */
    public $brandUrl = false;
    /**
     * @var array the HTML attributes of the brand link.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandOptions = [];


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'nav');
        echo Html::beginTag($tag, $options);

        Html::addCssClass($this->containerOptions, 'nav-wrapper');
        $options = $this->containerOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::beginTag($tag, $options);

        if ($this->brandLabel !== false) {
            Html::addCssClass($this->brandOptions, 'brand-logo');
            echo Html::a($this->brandLabel, $this->brandUrl === false ? \Yii::$app->homeUrl : $this->brandUrl, $this->brandOptions);
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $tag = ArrayHelper::remove($this->containerOptions, 'tag', 'div');
        echo Html::endTag($tag);

        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        echo Html::endTag($tag, $this->options);
        MaterializeAsset::register($this->getView());
    }
}