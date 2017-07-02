<?php

namespace tuyakhov\materialize;

use tuyakhov\materialize\Widget;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Alert extends Widget
{
    private $predefinedAlertLevels = [
        'error'   => 'error',
        'danger'  => 'danger',
        'success' => 'success',
        'info'    => 'info',
        'warning' => 'warning'
    ];
    public $alertLevels = [];
    public $options = [];

    public function init()
    {
        parent::init();

        $this->alertLevels = ArrayHelper::merge($this->predefinedAlertLevels, $this->alertLevels);
    }

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->alertLevels[$type])) {
                $data = (array) $data;
                foreach ($data as $i => $message) {
                    /* initialize css class for each alert box */
                    $this->options['class'] = 'alert ' . $this->alertLevels[$type] . $appendCss;

                    /* assign unique id to each alert box */
                    $this->options['id'] = $this->getId() . '-' . $type . '-' . $i;

                    echo $this->renderHtml($message, $this->options);
                }

                $session->removeFlash($type);
            }
        }
    }

    /**
     * @param $message
     * @param array $options
     * @return string
     */
    private function renderHtml($message, $options = [])
    {
        $html = Html::beginTag('div', $options);
        $html .= '<div class="card-panel">';
        $html .= $message;
        $html .= '</div>';
        $html .= Html::endTag('div');

        return $html;
    }
}
