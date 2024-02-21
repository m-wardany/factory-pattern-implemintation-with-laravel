<?php
namespace App\Services\Suppliers\Suppliers\Foo;

use App\Services\Suppliers\Interfaces\SupplierLoginInterface;
use External\Foo\Auth\AuthWS;
use Illuminate\Auth\AuthenticationException;

final class SupplierLogin implements SupplierLoginInterface
{

    /**
     * @param string $login
     * @param string $password
     * @exception AuthenticationException
     * @return boolean
     */
    public function login(string $login, string $password): true
    {
        try {
            (new AuthWS)->authenticate($login, $password);
            return true;
        } catch (\External\Foo\Exceptions\AuthenticationFailedException $th) {
            throw new AuthenticationException();
        }

    }

    function context(): string
    {
        return 'FOO';
    }
}
