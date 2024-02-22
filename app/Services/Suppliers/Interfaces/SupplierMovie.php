<?php
namespace App\Services\Suppliers\Interfaces;

abstract class SupplierMovie
{
    protected $maxRetries = 3;
    protected $sleep;

    function __construct()
    {
        $this->sleep = config("services.moviesSuppliers.sleep");
        $this->maxRetries = config("services.moviesSuppliers.retries");
    }

    abstract function moviesList(): array;
    abstract function cacheKey(): string;
}