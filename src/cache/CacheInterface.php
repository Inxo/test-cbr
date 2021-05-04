<?php

namespace App\Cache;

use App\Models\CurrencyDaily;

interface CacheInterface
{
    public function get(string $date) : ?CurrencyDaily;

    public function put(string $date, CurrencyDaily $data);
}