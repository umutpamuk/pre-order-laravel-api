<?php

namespace App\Services\Product;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ProductServiceInterface
{

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection;

    /**
     * @return AnonymousResourceCollection
     */
    public function allAvailable(): AnonymousResourceCollection;
}
