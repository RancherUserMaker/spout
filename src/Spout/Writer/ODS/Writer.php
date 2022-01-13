<?php

namespace Rancherusermaker\Spout\Writer\ODS;

use Rancherusermaker\Spout\Writer\Common\Entity\Options;
use Rancherusermaker\Spout\Writer\WriterMultiSheetsAbstract;

/**
 * Class Writer
 * This class provides base support to write data to ODS files
 */
class Writer extends WriterMultiSheetsAbstract
{
    /** @var string Content-Type value for the header */
    protected static $headerContentType = 'application/vnd.oasis.opendocument.spreadsheet';

    /**
     * Sets a custom temporary folder for creating intermediate files/folders.
     * This must be set before opening the writer.
     *
     * @param string $tempFolder Temporary folder where the files to create the ODS will be stored
     * @throws \Rancherusermaker\Spout\Writer\Exception\WriterAlreadyOpenedException If the writer was already opened
     * @return Writer
     */
    public function setTempFolder($tempFolder)
    {
        $this->throwIfWriterAlreadyOpened('Writer must be configured before opening it.');

        $this->optionsManager->setOption(Options::TEMP_FOLDER, $tempFolder);

        return $this;
    }
}
