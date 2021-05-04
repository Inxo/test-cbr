<?php


namespace App\Models;


use App\Datasource\CurrencyResult;

class CbrResult implements CurrencyResult
{

    /**
     * @var float
     */
    private $value;
    /**
     * @var float
     */
    private $diff;

    public function __construct(float $value, float $diff)
    {
        $this->value = $value;
        $this->diff = $diff;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getDiff(): float
    {
        return $this->diff;
    }
}