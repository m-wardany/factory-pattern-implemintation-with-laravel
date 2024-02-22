<?php
namespace App\Services\Suppliers\Exceptions;

use Exception;

class ServiceUnavailableException extends Exception
{
    protected $code = 500;
    protected $message = "Service unavailable";
}
