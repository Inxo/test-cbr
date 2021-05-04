<?php


namespace App\Cbr;


use App\ConsoleException;
use App\Models\CurrencyDaily;

class CbrApi
{
    const API_ENDPOINT = "https://www.cbr.ru/scripts/XML_daily.asp";
    /**
     * @var \App\Cbr\CbrXmlParser
     */
    private $xmlParser;

    public function __construct()
    {
        $this->xmlParser = new CbrXmlParser();
    }

    /**
     * @throws \Exception
     */
    public function get(string $date = ''): ?CurrencyDaily
    {
        $raw = $this->getXml($date);
        if (!$raw) {
            throw new ConsoleException('Error retrieve data');
        }

        return $this->xmlParser->parse($raw);
    }

    /**
     * @param string $date
     * @return bool|string
     */
    private function getXml(string $date) {
        $url = self::API_ENDPOINT;
        $curl = curl_init();
        if (!empty($date)) {
            $url .= '?' . http_build_query([
                    'date_req' => $date
                ]);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

}