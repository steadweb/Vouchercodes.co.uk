<?php

namespace Vouchercodes\Discount;

class Discount
{
    /**
     * @var int
     */
    private $threshold = 0;

    /**
     * @var int
     */
    private $amount = 0;

    /**
     * @var string
     */
    private $operator = '>';

    const MORE_THAN = '>';
    const MORE_THAN_EQUAL_TO = '>=';

    /**
     * Pass the threshold and amount of the discount
     *
     * @param $threshold
     * @param $amount
     * @param string $operator
     */
    public function __construct($threshold, $amount, $operator = '>')
    {
        $this->threshold = $threshold;
        $this->amount = $amount;
        $this->operator = $operator;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param $quantity
     * @return float
     */
    public function calculate($quantity)
    {
        switch($this->operator) {
            case static::MORE_THAN_EQUAL_TO:
                return $this->moreThanOrEqualTo($quantity);
                break;

            default:
            case static::MORE_THAN:
                return $this->moreThan($quantity);
                break;
        }
    }

    /**
     * @param $quantity
     * @return int
     */
    private function moreThan($quantity)
    {
        return ($quantity > $this->threshold) ? $this->amount : 0;
    }

    /**
     * @param $quantity
     * @return int
     */
    private function moreThanOrEqualTo($quantity)
    {
        return ($quantity >= $this->threshold) ? $this->amount : 0;
    }
}
