<?php

namespace KEBHanna\FinfluxSDK\Error;

use Exception;

class FinfluxException extends Exception{ 

    public function __construct($message, $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);

    }

}