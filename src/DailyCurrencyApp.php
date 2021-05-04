<?php

namespace App;

use App\Datasource\DataSourceInterface;
use Exception;

class DailyCurrencyApp
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * @throws Exception
     */
    public function __construct(DataSourceInterface $dataSource) {

        $this->dataSource = $dataSource;
    }

    /**
     * @throws Exception
     */
    public function run(string $date, string $charCode, string $baseCode = 'RUR'): Datasource\CurrencyResult
    {
        return $this->dataSource->getCurrencyByDate($date, $charCode, $baseCode);
    }
}