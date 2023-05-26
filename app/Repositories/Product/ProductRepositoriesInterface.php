<?php

namespace App\Repositories\Product;

use Illuminate\Support\Collection;

interface ProductRepositoriesInterface
{

    /**
     * @return Collection
     */
    public function all() : Collection;

    /**
     * @return Collection
     */
    public function allAvailable() : Collection;

}
