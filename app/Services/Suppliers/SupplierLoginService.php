<?php
namespace App\Services\Suppliers;

use App\Services\Suppliers\Factories\SupplierLoginFactory;
use App\Services\Suppliers\Interfaces\SupplierLoginInterface;
use Firebase\JWT\JWT;

final class SupplierLoginService
{

    private SupplierLoginInterface|null $supplierLoginInterface;
    public function __construct(private $login, private $password)
    {
        $this->supplierLoginInterface = SupplierLoginFactory::getInstance($login);
    }

    function execute(): ?string
    {
        try {
            if ($this->supplierLoginInterface && $this->supplierLoginInterface->login($this->login, $this->password)) {
                return JWT::encode([
                    'login' => $this->login,
                    'context' => $this->supplierLoginInterface->context()
                ], config('jwt.key'), config('jwt.algorithm'));
            }
            return null;
        } catch (\Illuminate\Auth\AuthenticationException $th) {
            return null;
        }
    }
}
