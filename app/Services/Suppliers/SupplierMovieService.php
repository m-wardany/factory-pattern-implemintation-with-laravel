<?php
namespace App\Services\Suppliers;

use App\Services\Suppliers\Interfaces\SupplierMovie;
use App\Services\Suppliers\Suppliers\Bar\SupplierMovies as BarSupplierMovies;
use App\Services\Suppliers\Suppliers\Baz\SupplierMovies as BazSupplierMovies;
use App\Services\Suppliers\Suppliers\Foo\SupplierMovies as FooSupplierMovies;

class SupplierMovieService
{

    function execute(): array
    {
        $moviesList = [];

        foreach ($this->suppliers() as $supplier) {
            $cachedData = cache()->remember(
                $supplier->cacheKey(),
                120,
                function () use ($supplier) {
                    return $supplier->moviesList();
                }
            );
            if ($cachedData) {
                $moviesList = array_merge($moviesList, $cachedData);
            }
        }
        sort($moviesList);
        return $moviesList;
    }

    /**
     * 
     * @return SupplierMovie[]
     */
    private function suppliers(): array
    {
        return [
            new BarSupplierMovies(),
            new BazSupplierMovies(),
            new FooSupplierMovies(),
        ];
    }

}
