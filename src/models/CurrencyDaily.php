<?php

namespace App\Models;

use App\ConsoleException;
use Serializable;

class CurrencyDaily implements Serializable
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    private $data;

    /**
     * @throws \App\ConsoleException
     */
    public function getByCode(string $code): ?CurrencyDailyItem
    {
        $code = mb_strtoupper($code);
        if (!array_key_exists($code, $this->data)) {
            throw new ConsoleException('Invalid currency');
        }

        return $this->data[$code];
    }

    public function serialize(): ?string
    {
        return serialize($this->data);
    }

    public function unserialize($data)
    {
        $this->data = unserialize($data);
    }
}