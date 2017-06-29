<?php

namespace App\Utils;

/**
 * Class Decorator
 *
 * @package App\Utils
 */
class Decorator
{

    /**
     * Original state of the model
     *
     * @var
     */
    protected $originalModel;

    /**
     * Decorated model
     *
     * @var
     */
    protected $model;


    /**
     * Decorator constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $this->originalModel = $model;
    }
}
