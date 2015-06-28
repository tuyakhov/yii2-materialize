<?php
/**
 * @author Anton Tuyakhov <atuyakhov@gmail.com>
 */

namespace tuyakhov\materialize;

use yii\helpers\Html;

/**
 * Toasts
 * @package tuyakhov\materialize
 * @see http://materializecss.com/dialogs.html
 */
class Toast extends Widget
{
    /**
     * @var string Toast message
     */
    public $message = 'Toast';
    /**
     * @var bool whether to encode message
     */
    public $encodeMessage = true;
    /**
     * @var integer|string showing duration in milliseconds
     */
    public $displayLength = 6000;
    /**
     * @var string name of the class that will be added to each toast
     */
    public $className = '';
    /**
     * @var string toast callback a function when it has been dismissed
     */
    public $completeCallback;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->clientOptions[] = (string)($this->encodeMessage ? Html::encode($this->message) : $this->message);
        $this->clientOptions[] = $this->displayLength;
        $this->clientOptions[] = $this->className;
        if ($this->completeCallback !== null) {
            $this->clientOptions[] = $this->completeCallback;
        }
        $this->registerPlugin('toast');
    }
}