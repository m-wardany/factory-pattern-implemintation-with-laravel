<?php
namespace App\Services\Suppliers\Suppliers\Foo;

use App\Services\Suppliers\Exceptions\ServiceUnavailableException as ExceptionsServiceUnavailableException;
use App\Services\Suppliers\Interfaces\SupplierMovie;
use External\Foo\Exceptions\ServiceUnavailableException;
use External\Foo\Movies\MovieService;

class SupplierMovies extends SupplierMovie
{
    function moviesList(): array
    {
        $tries = 0;
        while ($tries < $this->maxRetries) {
            try {
                $moviesList = (new MovieService)->getTitles();
                if ($moviesList) {
                    cache()->put($this->cacheKey(), $moviesList, 120);
                }
                return $moviesList;
            } catch (ServiceUnavailableException $e) {
                $tries++;
                sleep(pow($this->sleep, $tries));
            }
        }
        throw new ExceptionsServiceUnavailableException("Error Processing Request", 1);
        ;
    }

    function cacheKey(): string
    {
        return 'movies_list:foo';
    }

}
