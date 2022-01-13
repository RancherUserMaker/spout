<?php

namespace Rancherusermaker\Spout\Writer\Common\Creator;

use Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException;
use Rancherusermaker\Spout\TestUsingResource;
use PHPUnit\Framework\TestCase;

/**
 * Class WriterFactoryTest
 */
class WriterFactoryTest extends TestCase
{
    use TestUsingResource;

    /**
     * @return void
     */
    public function testCreateFromFileCSV()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.csv');
        $writer = WriterFactory::createFromFile($validCsv);
        $this->assertInstanceOf('Rancherusermaker\Spout\Writer\CSV\Writer', $writer);
    }

    /**
     * @return void
     */
    public function testCreateFromFileCSVAllCaps()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.CSV');
        $writer = WriterFactory::createFromFile($validCsv);
        $this->assertInstanceOf('Rancherusermaker\Spout\Writer\CSV\Writer', $writer);
    }

    /**
     * @return void
     */
    public function testCreateFromFileODS()
    {
        $validOds = $this->getResourcePath('csv_test_create_from_file.ods');
        $writer = WriterFactory::createFromFile($validOds);
        $this->assertInstanceOf('Rancherusermaker\Spout\Writer\ODS\Writer', $writer);
    }

    /**
     * @return void
     */
    public function testCreateFromFileXLSX()
    {
        $validXlsx = $this->getResourcePath('csv_test_create_from_file.xlsx');
        $writer = WriterFactory::createFromFile($validXlsx);
        $this->assertInstanceOf('Rancherusermaker\Spout\Writer\XLSX\Writer', $writer);
    }

    /**
     * @return void
     */
    public function testCreateWriterShouldThrowWithUnsupportedType()
    {
        $this->expectException(UnsupportedTypeException::class);

        WriterFactory::createFromType('unsupportedType');
    }

    /**
     * @return void
     */
    public function testCreateFromFileUnsupported()
    {
        $this->expectException(UnsupportedTypeException::class);
        $invalid = $this->getResourcePath('test_unsupported_file_type.other');
        WriterFactory::createFromFile($invalid);
    }
}
