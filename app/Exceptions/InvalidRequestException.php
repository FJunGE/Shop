<?php

namespace App\Exceptions;

use App\Http\Requests\Request;
use Exception;

class InvalidRequestException extends Exception
{
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {

        return view('pages.error', ['msg' => $this->message]);
    }
}
