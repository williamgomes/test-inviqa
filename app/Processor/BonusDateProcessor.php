<?php
namespace Willy\Processor;

use Willy\Processor\AbstractDuedateProcessor;
use Willy\Processor\DuedateProcessorInterface;

/**
 * Class BonusDateProcessor
 * @package Willy\Processor
 */
class BonusDateProcessor extends AbstractDuedateProcessor implements DuedateProcessorInterface
{

    /**
     * @param \DateTime $date
     * @return \DateTime
     */
    public function calculateDuedate(\DateTime $date)
    {
        $date->setDate($date->format('Y'), $date->format('m'), $this->getDefaultDuedate());
        $dayOfWeek = $date->format('w');

        if (in_array($dayOfWeek, $this->getPayableDays())) {
            return $date;
        }
        $date->modify($this->getFallbackDate());
        return $date;
    }
}