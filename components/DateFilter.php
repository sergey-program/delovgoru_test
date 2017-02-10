<?php

namespace app\components;

/**
 * Class DateFilter
 *
 * @package app\components
 */
class DateFilter
{
    public $y;
    public $m;

    /**
     * DateFilter constructor.
     *
     * @param null|int $y
     * @param null|int $m
     */
    public function __construct($y = null, $m = null)
    {
        if (!$y || !$m) {
            $this->y = date('Y');
            $this->m = date('n');
        } else {
            $this->y = $y;
            $this->m = $m;
        }
    }

    /**
     * Return string for month filter, for example "2016-11".
     *
     * @param string|null $type
     *
     * @return string
     */
    public function getNext($type = null)
    {
        if ($this->m == 12) { // next year first month
            $nM = 1;
            $nY = $this->y + 1;
        } else {
            $nM = $this->m + 1;
            $nY = $this->y;
        }

        if ($type == 'm') {
            return $nM;
        } elseif ($type == 'y') {
            return $nY;
        } else {
            return $nY . '-' . $nM;
        }
    }

    /**
     * Return string for month filter, for example "2016-11".
     *
     * @param string|null $type
     *
     * @return string
     */
    public function getPrev($type = null)
    {
        if ($this->m == 1) {
            $pY = $this->y - 1;
            $pM = 12;

        } else {
            $pY = $this->y;
            $pM = $this->m - 1;
        }

        if ($type == 'm') {
            return $pM;
        } elseif ($type == 'y') {
            return $pY;
        } else {
            return $pY . '-' . $pM;
        }
    }
}