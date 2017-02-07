<?php
namespace Willy\Processor;

/**
 * Class AbstractDuedateProcessor
 * @package Willy\Processor
 */
abstract class AbstractDuedateProcessor
{

    /**
     * @var mixed
     */
    private $_defaultDuedate;

    /**
     * @var mixed
     */
    private $_payableDays;

    /**
     * @var mixed
     */
    private $_fallbackDate;
    
    /**
     * @var mixed
     */
    private $_name;


    /**
     * AbstractDuedateProcessor constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->_defaultDuedate = $config['default_date'];
        $this->_payableDays = $config['valid_days'];
        $this->_fallbackDate = $config['fallback_date'];
        $this->_name = $config['name'];
    }

    /**
     * @param \DateTime $date
     * @return mixed
     */
    abstract public function calculateDuedate(\DateTime $date);

    /**
     * @param \DateTime $date
     * @return \DateTime
     */
    public function calculateFallback(\DateTime $date)
    {
        $date->modify($this->getFallbackDate());
        return $date;
    }


    /**
     * @return mixed
     */
    public function getDefaultDuedate()
    {
        return $this->_defaultDuedate;
    }

    /**
     * @return mixed
     */
    public function getPayableDays()
    {
        return $this->_payableDays;
    }

    /**
     * @return mixed
     */
    public function getFallbackDate()
    {
        return $this->_fallbackDate;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

}