<?php


namespace App\Exceptions;


use Throwable;

class InvalidParameters extends \Exception
{
    public function __construct($parameter)
    {
        parent::__construct("Invalid parameter: " . $parameter, 0, null);
    }
}
