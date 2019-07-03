<?php

namespace App\Helper;

final class Counter
{
    /**
     * @var int
     */
    private $currentValue = 0;

    /**
     * @return Counter
     */
    public function plus(): Counter
    {
        $this->currentValue += 1;

        return $this;
    }

    /**
     * @return Counter
     */
    public function minus(): Counter
    {
        $this->currentValue -= 1;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentValue(): int
    {
        return $this->currentValue;
    }
}