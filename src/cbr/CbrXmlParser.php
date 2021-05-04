<?php


namespace App\Cbr;


use App\Models\CurrencyDaily;
use App\Models\CurrencyDailyItem;
use DateTime;
use SimpleXMLElement;

class CbrXmlParser
{
    /**
     * @throws \Exception
     */
    public function parse(string $rawData): CurrencyDaily
    {
        $data = [];
        $simple = new SimpleXMLElement($rawData);
        $date = (string)$simple->attributes()->Date;
        $date = DateTime::createFromFormat('d.m.Y', $date);
        foreach ($simple->Valute as $row) {
            $item = new CurrencyDailyItem();
            $item->setDate($date->format('Y-m-d'));
            $item->setValue((float) str_replace(',','.',$row->Value));
            $item->setValute((string) $row->attributes()->ID);
            $item->setCharCode((string) $row->CharCode);
            $item->setName((string) $row->Name);
            $item->setNumCode((string) $row->NumCode);
            $item->setNominal((int) $row->Nominal);

            $data[$item->getCharCode()] = $item;
        }

        return new CurrencyDaily($data);
    }
}