<?php

namespace Sfinktah\Neto;

class InvalidOutputSelector extends \Exception
{
    public function __construct($message = "Invalid item found in OutputSelector", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}