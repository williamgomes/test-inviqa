<?php
namespace Willy\Tests\Unit;

use Willy\Processor\SalaryDateProcessor;
use Willy\Helper\DataFormatArray;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BonusDateProcessorTest
 * @package Willy\Tests\Unit
 */
class SalaryDateProcessorTest extends \PHPUnit_Framework_TestCase
{

    private $_salaryDuedateProcessor, $_dataFormat, $_testYear;


    
    public function setUp()
    {
        parent::setUp();

        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../config.yml'));
        $this->_salaryDuedateProcessor = new SalaryDateProcessor($config['settings']['data_type']['salary']);
        $this->_dataFormat = new DataFormatArray();
        $this->_testYear = 2017;
    }

    public function testCheckPayableDays()
    {
        $payableDays = $this->_salaryDuedateProcessor->getPayableDays();

        $this->assertEquals($payableDays, [1,2,3,4,5]);
    }

    public function testForMonthJanuary()
    {
        $date = new \DateTime();
        $date->setDate($this->_testYear,01,01); //setting date to first of january
        $salaryDate = $this->_salaryDuedateProcessor->calculateDueDate($date);

        $this->assertEquals($this->_dataFormat->formatDayOfPayment($salaryDate), '31-Jan-2017');
    }

    public function testForMonthFebruary()
    {
        $date = new \DateTime();
        $date->setDate($this->_testYear,02,01); //setting date to first of march
        $salaryDate = $this->_salaryDuedateProcessor->calculateDueDate($date);

        $this->assertEquals($this->_dataFormat->formatDayOfPayment($salaryDate), '28-Feb-2017');
    }

    public function testForMonthApril()
    {
        $date = new \DateTime();
        $date->setDate($this->_testYear,04,01); //setting date to first of march
        $salaryDate = $this->_salaryDuedateProcessor->calculateDueDate($date);

        $this->assertEquals($this->_dataFormat->formatDayOfPayment($salaryDate), '28-Apr-2017');
    }

}