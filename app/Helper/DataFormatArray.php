<?php
namespace Willy\Helper;

use Willy\Helper\DataFormatInterface;

/**
 * Class DataFormatArray
 * @package Willy\Helper
 */
class DataFormatArray
{

    /**
     * @var array
     */
    private $_DueDatesColl;

    /**
     * DataFormatArray constructor.
     */
    public function __construct()
    {
        $this->_DueDatesColl = array();
    }


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
    private function formatMonthOfYear(\DateTime $date)
    {
        return $date->format("M, Y");
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    private function formatDayOfPayment(\DateTime $date)
    {
        return $date->format("d-M-Y");
    }


}