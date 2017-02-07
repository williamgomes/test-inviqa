<?php
namespace Willy\Tests\Unit;

use Willy\Processor\BonusDateProcessor;
use Willy\Helper\DataFormatArray;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BonusDateProcessorTest
 * @package Willy\Tests\Unit
 */
class BonusDateProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    private $_bonusDuedateProcessor;

    /**
     * @var
     */
    private $_dataFormat;

    /**
     * @var
     */
    private $_testYear;

    public function setUp()
    {
        parent::setUp();

        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../config.yml'));
        $this->_bonusDuedateProcessor = new BonusDateProcessor($config['settings']['data_type']['bonus']);
        $this->_dataFormat = new DataFormatArray();
        $this->_testYear = 2017;
    }

    public function testCheckPayableDays()
    {
        $payableDays = $this->_bonusDuedateProcessor->getPayableDays();

        $this->assertEquals($payableDays, [1,2,3,4,5]);
    }

    public function testForMonthJanuary()
    {
        $date = new \DateTime();
        $date->setDate($this->_testYear,01,01); //setting date to first of january
        $bonusDate = $this->_bonusDuedateProcessor->calculateDueDate($date);

        $this->assertEquals($this->_dataFormat->formatDayOfPayment($bonusDate), '18-Jan-2017');
    }

    public function testForMonthMarch()
    {
        $date = new \DateTime();
        $date->setDate($this->_testYear,03,01); //setting date to first of march
        $bonusDate = $this->_bonusDuedateProcessor->calculateDueDate($date);

        $this->assertEquals($this->_dataFormat->formatDayOfPayment($bonusDate), '15-Mar-2017');
    }

}