<?php
namespace Willy\Processor;

/**
 * Interface DuedateProcessorInterface
 * @package Willy\Processor
 */
interface DuedateProcessorInterface
{
    /**
     * @param \DateTime $date
     * @return mixed
     */
    public function calculateDuedate(\DateTime $date);

    /**
     * @return mixed
     */
    public function getFallbackDate();

    /**
     * @return mixed
     */
    public function getName();

}