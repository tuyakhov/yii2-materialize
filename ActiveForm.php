<?php

namespace tuyakhov\materialize;

/**
 * This is just an example.
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'tuyakhov\materialize\ActiveField';
}
