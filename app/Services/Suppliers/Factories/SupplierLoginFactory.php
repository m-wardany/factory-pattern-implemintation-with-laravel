<?php
namespace App\Services\Suppliers\Factories;

use App\Services\Suppliers\Interfaces\SupplierLoginInterface;
use App\Services\Suppliers\Suppliers\Foo\SupplierLogin as FooSupplierLogin;
use App\Services\Suppliers\Suppliers\Bar\SupplierLogin as BarSupplierLogin;
use App\Services\Suppliers\Suppliers\Baz\SupplierLogin as BazSupplierLogin;

class SupplierLoginFactory
{
    static function getInstance(string $login): ?SupplierLoginInterface
    {
        preg_match("/^(BAZ|BAR|FOO)_.*/", request()->input('login'), $matches);

        switch (data_get($matches, 1)) {
            case 'BAR':
                return new BarSupplierLogin;
            case 'BAZ':
                return new BazSupplierLogin;
            case 'FOO':
                return new FooSupplierLogin;
            default:
                return null;
        }
    }
}
