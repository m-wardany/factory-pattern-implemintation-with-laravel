<?php
namespace App\Services\Suppliers\Interfaces;

interface SupplierLoginInterface
{
    /**
     * @param string $login
     * @param string $password
     * @exception \Illuminate\Auth\AuthenticationException
     * @return boolean
     */
    public function login(string $login, string $password): true;

    public function context(): string;
}