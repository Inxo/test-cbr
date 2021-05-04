<?php


namespace App\Datasource;


interface DataSourceInterface
{
    public function getCurrencyByDate(string $date, string $charCode, string $baseCode) : CurrencyResult;
}