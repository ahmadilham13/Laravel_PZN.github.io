<?php 

namespace App\Exceptions;
use TheSeer\Tokenizer\Exception;

class ValidationException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}

?>