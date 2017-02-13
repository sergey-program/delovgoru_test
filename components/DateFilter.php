<?php

namespace app\components;

use app\models\Notice;

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
     * Empty models with cm and cy.
     *
     * @var Notice[]|array
     */
    public $dateArray = [];

    /**
     * DateFilter constructor.
     *
     * @param null|int $y
     * @param null|int $m
     */
    public function __construct($y = null, $m = null)
    {
        $this->calculateDateArray();
        $this->calculateDefaultDate($y, $m);
    }

    /**
     * Return string for month filter, for example "2016-11".
     *
     * @param string|null $type
     *
     * @return string|null
     */
    public function getNext($type = null)
    {
        $nextNotice = null;

        foreach ($this->dateArray as $key => $notice) {
            if ($this->m == $notice->cm && $this->y == $notice->cy) {
                // found current date
                if (isset($this->dateArray[$key + 1])) {
                    // if isset next date, assign
                    $nextNotice = $this->dateArray[$key + 1];
                }

                break;
            }
        }

        if ($nextNotice) {
            if ($type == 'm') {
                return $nextNotice->cm;
            } elseif ($type == 'y') {
                return $nextNotice->cy;
            } else {
                return $nextNotice->cy . '-' . $nextNotice->cm;
            }

        }

        return $nextNotice;
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
        $prevNotice = null;

        foreach ($this->dateArray as $key => $notice) {
            if ($this->m == $notice->cm && $this->y == $notice->cy) {
                // found current date
                if (isset($this->dateArray[$key - 1])) {
                    // if isset next date, assign
                    $prevNotice = $this->dateArray[$key - 1];
                }

                break;
            }
        }

        if ($prevNotice) {
            if ($type == 'm') {
                return $prevNotice->cm;
            } elseif ($type == 'y') {
                return $prevNotice->cy;
            } else {
                return $prevNotice->cy . '-' . $prevNotice->cm;
            }

        }

        return $prevNotice;
    }

    /**
     * Select all dates we have.
     */
    public function calculateDateArray()
    {
        $this->dateArray = Notice::find()
            ->distinct()
            ->select(['MONTH(oncreate) AS cm', 'YEAR(oncreate) AS cy'])
            ->orderBy('oncreate')
            ->all();
    }

    /**
     * Select default date that exists, or use current (can be empty).
     *
     * @param int $y // 2017
     * @param int $m // 2
     */
    public function calculateDefaultDate($y, $m)
    {
        if (!$y || !$m) {
            $this->y = date('Y');
            $this->m = date('n');
        } else {
            $this->y = $y;
            $this->m = $m;
        }

        $found = false;

        foreach ($this->dateArray as $key => $notice) {
            if ($this->m == $notice->cm && $this->y == $notice->cy) {
                $found = true;// found current date

                break;
            }
        }

        if (!$found && isset($this->dateArray[0])) {
            $this->y = $this->dateArray[0]->cy;
            $this->m = $this->dateArray[0]->cm;
        }
    }
}