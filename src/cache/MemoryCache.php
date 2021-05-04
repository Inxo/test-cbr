<?php

namespace App\Cache;

use App\Models\CurrencyDaily;

class MemoryCache implements CacheInterface
{

    private $data = [];

    public function get(string $date) : ?CurrencyDaily
    {
        return $this->data[$date] ?? null;
    }

    public function put(string $date, CurrencyDaily $data)
    {
        $this->data[$date] = $data;
    }
}