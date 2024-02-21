<?php
namespace App\Services\Suppliers\Suppliers\Bar;

use App\Services\Suppliers\Interfaces\SupplierLoginInterface;
use External\Bar\Auth\LoginService;
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
        if ((new LoginService)->login($login, $password) === true) {
            return true;
        }
        throw new AuthenticationException();
    }

    function context(): string
    {
        return 'BAR';
    }
}
