<?php
namespace App\Services\Suppliers\Suppliers\Bar;

use App\Services\Suppliers\Exceptions\ServiceUnavailableException as ExceptionsServiceUnavailableException;
use App\Services\Suppliers\Interfaces\SupplierMovie;
use External\Bar\Exceptions\ServiceUnavailableException;
use External\Bar\Movies\MovieService;

class SupplierMovies extends SupplierMovie
{
    function moviesList(): array
    {
        $tries = 0;
        while ($tries < $this->maxRetries) {
            try {
                $moviesList = collect(data_get((new MovieService)->getTitles(), 'titles'))->pluck('title')->toArray();
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
        return 'movies_list:bar';
    }

}
