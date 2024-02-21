<?php
namespace App\Services\Suppliers\Suppliers\Baz;

use App\Services\Suppliers\Interfaces\SupplierLoginInterface;
use External\Baz\Auth\Authenticator;
use External\Baz\Auth\Responses\Success;
use Illuminate\Auth\AuthenticationException;

class SupplierLogin implements SupplierLoginInterface
{

    /**
     * @param string $login
     * @param string $password
     * @exception AuthenticationException
     * @return boolean
     */
    public function login(string $login, string $password): true
    {
        if ((new Authenticator)->auth($login, $password) instanceof Success) {
            return true;
        }
        throw new AuthenticationException();
    }

    function context(): string
    {
        return 'BAZ';
    }
}
