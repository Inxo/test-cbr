<?php

namespace App\Models;

use Serializable;

class CurrencyDailyItem implements Serializable
{
    private $date;
    private $valute;
    private $numCode;
    private $charCode;
    private $nominal;
    private $name;
    private $value;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getValute()
    {
        return $this->valute;
    }

    /**
     * @param mixed $valute
     */
    public function setValute($valute): void
    {
        $this->valute = $valute;
    }

    /**
     * @return string
     */
    public function getNumCode(): string
    {
        return $this->numCode;
    }

    /**
     * @param string $numCode
     */
    public function setNumCode(string $numCode): void
    {
        $this->numCode = $numCode;
    }

    /**
     * @return string
     */
    public function getCharCode(): string
    {
        return $this->charCode;
    }

    /**
     * @param string $charCode
     */
    public function setCharCode(string $charCode): void
    {
        $this->charCode = $charCode;
    }

    /**
     * @return int
     */
    public function getNominal(): int
    {
        return $this->nominal;
    }

    /**
     * @param int $nominal
     */
    public function setNominal(int $nominal): void
    {
        $this->nominal = $nominal;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($data)
    {
        // TODO: Implement unserialize() method.
    }
}