<?php

namespace App\Datasource;

use App\Cache\CacheInterface;
use App\Cbr\CbrApi;
use App\ConsoleException;
use App\Models\CbrResult;
use App\Models\CurrencyDaily;
use DateInterval;
use DateTime;

class CbrDataSource implements DataSourceInterface
{
    const BASE_CODE = 'RUR';

    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var \App\Cbr\CbrApi
     */
    private $api;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->api = new CbrApi();
    }

    /**
     * @throws \Exception
     */
    public function getCurrencyByDate(string $date, string $charCode, string $baseCode) : CurrencyResult
    {
        if(!$this->validateDate($date)){
            throw new ConsoleException('Invalid date');
        }

        if ($charCode === $baseCode) { // just optimize :)
            return new CbrResult(1.0000,0.0000);
        }

        $currDate = new DateTime($date);
        $prevDate = clone new DateTime($date);
        $prevDate->sub(new DateInterval('P1D'));

        $dateResult = $this->get($currDate->format('d/m/Y'));
        $prevDateResult = $this->get($prevDate->format('d/m/Y'));

        $value = $dateResult->getByCode($charCode)->getValue();
        $prevValue = $prevDateResult->getByCode($charCode)->getValue();

        if ($baseCode !== self::BASE_CODE) {
            $value /= $dateResult->getByCode($baseCode)->getValue();
            $prevValue /= $prevDateResult->getByCode($baseCode)->getValue();
        }

        return new CbrResult($value, $value - $prevValue);
    }

    /**
     * @param string $date
     * @return \App\Models\CurrencyDaily
     * @throws \Exception
     */
    private function get(string $date): CurrencyDaily
    {
        if ($data = $this->cache->get($date)) {
            return $data;
        }

        $data = $this->api->get($date);
        $this->cache->put($date, $data);
        return $data;
    }

    /**
     * @param string $date
     * @return bool
     */
    private function validateDate(string $date): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        $nextd = new DateTime();
        $nextd->add(new DateInterval('P1D'));
        // todo: учет установки курса на следующую дату, после полудня установлен
        return $d && $d->format('Y-m-d') === $date && $d < $nextd;
    }
}