<?php

namespace Rancherusermaker\Spout\Writer\Common\Creator;

use Rancherusermaker\Spout\Common\Entity\Cell;
use Rancherusermaker\Spout\Common\Entity\Row;
use Rancherusermaker\Spout\Common\Entity\Style\Style;
use Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException;
use Rancherusermaker\Spout\Common\Type;
use Rancherusermaker\Spout\Writer\WriterInterface;

/**
 * Class WriterEntityFactory
 * Factory to create external entities
 */
class WriterEntityFactory
{
    /**
     * This creates an instance of the appropriate writer, given the type of the file to be written
     *
     * @param  string $writerType Type of the writer to instantiate
     * @throws \Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException
     * @return WriterInterface
     */
    public static function createWriter($writerType)
    {
        return WriterFactory::createFromType($writerType);
    }

    /**
     * This creates an instance of the appropriate writer, given the extension of the file to be written
     *
     * @param string $path The path to the spreadsheet file. Supported extensions are .csv, .ods and .xlsx
     * @throws \Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException
     * @return WriterInterface
     */
    public static function createWriterFromFile(string $path)
    {
        return WriterFactory::createFromFile($path);
    }

    /**
     * This creates an instance of a CSV writer
     *
     * @return \Rancherusermaker\Spout\Writer\CSV\Writer
     */
    public static function createCSVWriter()
    {
        try {
            return WriterFactory::createFromType(Type::CSV);
        } catch (UnsupportedTypeException $e) {
            // should never happen
            return null;
        }
    }

    /**
     * This creates an instance of a XLSX writer
     *
     * @return \Rancherusermaker\Spout\Writer\XLSX\Writer
     */
    public static function createXLSXWriter()
    {
        try {
            return WriterFactory::createFromType(Type::XLSX);
        } catch (UnsupportedTypeException $e) {
            // should never happen
            return null;
        }
    }

    /**
     * This creates an instance of a ODS writer
     *
     * @return \Rancherusermaker\Spout\Writer\ODS\Writer
     */
    public static function createODSWriter()
    {
        try {
            return WriterFactory::createFromType(Type::ODS);
        } catch (UnsupportedTypeException $e) {
            // should never happen
            return null;
        }
    }

    /**
     * @param Cell[] $cells
     * @param Style|null $rowStyle
     * @return Row
     */
    public static function createRow(array $cells = [], Style $rowStyle = null)
    {
        return new Row($cells, $rowStyle);
    }

    /**
     * @param array $cellValues
     * @param Style|null $rowStyle
     * @return Row
     */
    public static function createRowFromArray(array $cellValues = [], Style $rowStyle = null)
    {
        $cells = \array_map(function ($cellValue) {
            return new Cell($cellValue);
        }, $cellValues);

        return new Row($cells, $rowStyle);
    }

    /**
     * @param mixed $cellValue
     * @param Style|null $cellStyle
     * @return Cell
     */
    public static function createCell($cellValue, Style $cellStyle = null)
    {
        return new Cell($cellValue, $cellStyle);
    }
}
