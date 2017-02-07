<?php
namespace Willy\Writer;

use League\Csv\Writer;
use Willy\Writer\FileWriterInterface;

/**
 * Class CsvWriter
 * @package Willy\Writer
 */
class CsvWriter
{
    /**
     * @var
     */
    private $filename;

    private $fullFilePath;

    /**
     * @var resource
     */
    private $fileHandle;

    /**
     * CsvWriter constructor.
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->filename = $fileName;
        $this->fullFilePath = __DIR__ . '/../../' . $fileName;

        //clean up (remove file if exists)
        if (file_exists($this->fullFilePath)) {
            unset($fullFilePath);
        }
        $this->fileHandle = fopen($this->fullFilePath, 'w');
    }

    /**
     * Append data to the file
     *
     * @param $data
     */
    public function appendData($data)
    {
        fputcsv($this->fileHandle, $data);
    }
}