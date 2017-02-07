<?php
namespace Willy\Helper;

/**
 * Class DataFormatArray
 * @package Willy\Helper
 */
class DataFormatArray
{

    /**
     * @param \DateTime $date
     * @return array
     */
    public function getFormattedDuedate(\DateTime $date)
    {
        return [$this->formatMonthOfYear($date), $this->formatDayOfPayment($date)];
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function formatMonthOfYear(\DateTime $date)
    {
        return $date->format("M, Y");
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function formatDayOfPayment(\DateTime $date)
    {
        return $date->format("d-M-Y");
    }


}