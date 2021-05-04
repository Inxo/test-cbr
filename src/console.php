<?php

require __DIR__ .'/../vendor/autoload.php';

use App\Cache\MemoryCache;
use App\Datasource\CbrDataSource;
use App\ConsoleException;
use App\DailyCurrencyApp;

try {
    if (count($argv) < 3) {
        throw new ConsoleException('Arguments required');
    }

    $date = $argv[1];
    $charCode = $argv[2];
    $baseCode = $argv[3] ?? 'RUR';

    $cache = new MemoryCache();
    $source = new CbrDataSource($cache);
    $app = new DailyCurrencyApp($source);

    $result = $app->run($date, $charCode, $baseCode);
    $sign = ($result->getDiff() >= 0) ? '+' : '';
    echo $result->getValue() . ' (' . $sign . $result->getDiff() . ')' . PHP_EOL;

    // check memory cache
    // $result = $app->run($date, $charCode, $baseCode);

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
