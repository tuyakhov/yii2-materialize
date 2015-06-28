<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;


use yii\helpers\Json;

trait WidgetTrait
{
    /**
     * @var array the options for the underlying Materialize JS plugin.
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Materialize JS plugin.
     */
    public $clientEvents = [];


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific Materialize plugin and the related events
     * @param string $name the name of the Materialize Jquery plugin
     * @param string $selector the Jquery selector of the Materialize Jquery plugin
     */
    protected function registerJqueryPlugin($name, $selector = null)
    {
        $view = $this->getView();

        MaterializePluginAsset::register($view);

        if ($selector === null) {
            $selector = '#' . $this->options['id'];
        }

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('$selector').$name($options);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }

    /**
     * @param string $name the name of the Materialize plugin
     */
    protected function registerPlugin($name)
    {
        $view = $this->getView();

        MaterializePluginAsset::register($view);

        if ($this->clientOptions !== false && is_array($this->clientOptions)) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "Materialize.$name.apply(null, $options);";
            $view->registerJs($js);
        }
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     * @since 2.0.2
     */
    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            $id = $this->options['id'];
            $js = [];
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
            $this->getView()->registerJs(implode("\n", $js));
        }
    }
}