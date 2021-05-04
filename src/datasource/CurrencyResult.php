<?php


namespace App\Datasource;


interface CurrencyResult
{
    public function getValue(): float;
    public function getDiff(): float;
}