<?php

namespace Willy;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Yaml\Yaml;
use Willy\Helper\DataFormatArray;
use Willy\Writer\CsvWriter;


class PaydayGeneratorCommand extends Command
{

    /**
     * Configure Console Comand
     */
    protected function configure()
    {
        $this
            ->setName('payday:generate')
            ->setDescription('Generation two different excel payday reports')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'Specify an output filename!'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $filename   = $input->getArgument('filename');
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../config.yml'));

        //setting timezone defined in config
        date_default_timezone_set($config['settings']['timezone']);

        $date = new \DateTime();

        $dataProcessors = $this->getDataProcessor($config['settings']['data_type']);

        $output->writeln('Start of Report Generation Process');
        $output->writeln('====================================');

        foreach($dataProcessors AS $processor)
        {
            //initializing the day to the first day of january of given year
            $date->setDate($config['settings']['financial_year'], 1, 1);
            
            $dataFormatter = new DataFormatArray();

            //creating the file name
            $wholeFileName = $processor->getName() . '-' . $filename;
            $csvWriter = new CsvWriter($wholeFileName);

            $output->writeln(sprintf('Generating report for Processes: <info>%s</info>', $processor->getName()));
            $output->writeln(sprintf('Filename: <info>%s</info>', $wholeFileName));

            //inserting header for csv
            $csvWriter->appendData($config['settings']['report_type']['csv']['header']);
            $output->writeln('Process started.');

            for($i = 1; $i <= 12; $i++)
            {
                $processor->calculateDuedate($date);
                $csvWriter->appendData($dataFormatter->getFormattedDuedate($date));

                $date->modify('first day of next month');

                $output->write('.');
            }
            $output->writeln(sprintf('Report Generation completed for <info>%s</info>', $processor->getName()));
            $output->writeln(sprintf('File name: <info>%s</info>', $wholeFileName));

        }

        $output->writeln('End of Report Generation Process');
        $output->writeln('====================================');
    }

    /**
     * @param $config
     * @return array
     */
    public function getDataProcessor($config)
    {
        $output = [];
        foreach($config AS $con)
        {
            $className = $con['class'];
            
            $output[] = new $className($con);
        }

        return $output;
    }

}