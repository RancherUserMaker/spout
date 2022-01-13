<?php

namespace Rancherusermaker\Spout\Reader\Common\Creator;

use Rancherusermaker\Spout\Common\Creator\HelperFactory;
use Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException;
use Rancherusermaker\Spout\Common\Type;
use Rancherusermaker\Spout\Reader\CSV\Creator\InternalEntityFactory as CSVInternalEntityFactory;
use Rancherusermaker\Spout\Reader\CSV\Manager\OptionsManager as CSVOptionsManager;
use Rancherusermaker\Spout\Reader\CSV\Reader as CSVReader;
use Rancherusermaker\Spout\Reader\ODS\Creator\HelperFactory as ODSHelperFactory;
use Rancherusermaker\Spout\Reader\ODS\Creator\InternalEntityFactory as ODSInternalEntityFactory;
use Rancherusermaker\Spout\Reader\ODS\Creator\ManagerFactory as ODSManagerFactory;
use Rancherusermaker\Spout\Reader\ODS\Manager\OptionsManager as ODSOptionsManager;
use Rancherusermaker\Spout\Reader\ODS\Reader as ODSReader;
use Rancherusermaker\Spout\Reader\ReaderInterface;
use Rancherusermaker\Spout\Reader\XLSX\Creator\HelperFactory as XLSXHelperFactory;
use Rancherusermaker\Spout\Reader\XLSX\Creator\InternalEntityFactory as XLSXInternalEntityFactory;
use Rancherusermaker\Spout\Reader\XLSX\Creator\ManagerFactory as XLSXManagerFactory;
use Rancherusermaker\Spout\Reader\XLSX\Manager\OptionsManager as XLSXOptionsManager;
use Rancherusermaker\Spout\Reader\XLSX\Manager\SharedStringsCaching\CachingStrategyFactory;
use Rancherusermaker\Spout\Reader\XLSX\Reader as XLSXReader;

/**
 * Class ReaderFactory
 * This factory is used to create readers, based on the type of the file to be read.
 * It supports CSV, XLSX and ODS formats.
 */
class ReaderFactory
{
    /**
     * Creates a reader by file extension
     *
     * @param string $path The path to the spreadsheet file. Supported extensions are .csv,.ods and .xlsx
     * @throws \Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException
     * @return ReaderInterface
     */
    public static function createFromFile(string $path)
    {
        $extension = \strtolower(\pathinfo($path, PATHINFO_EXTENSION));

        return self::createFromType($extension);
    }

    /**
     * This creates an instance of the appropriate reader, given the type of the file to be read
     *
     * @param  string $readerType Type of the reader to instantiate
     * @throws \Rancherusermaker\Spout\Common\Exception\UnsupportedTypeException
     * @return ReaderInterface
     */
    public static function createFromType($readerType)
    {
        switch ($readerType) {
            case Type::CSV: return self::createCSVReader();
            case Type::XLSX: return self::createXLSXReader();
            case Type::ODS: return self::createODSReader();
            default:
                throw new UnsupportedTypeException('No readers supporting the given type: ' . $readerType);
        }
    }

    /**
     * @return CSVReader
     */
    private static function createCSVReader()
    {
        $optionsManager = new CSVOptionsManager();
        $helperFactory = new HelperFactory();
        $entityFactory = new CSVInternalEntityFactory($helperFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new CSVReader($optionsManager, $globalFunctionsHelper, $entityFactory);
    }

    /**
     * @return XLSXReader
     */
    private static function createXLSXReader()
    {
        $optionsManager = new XLSXOptionsManager();
        $helperFactory = new XLSXHelperFactory();
        $managerFactory = new XLSXManagerFactory($helperFactory, new CachingStrategyFactory());
        $entityFactory = new XLSXInternalEntityFactory($managerFactory, $helperFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new XLSXReader($optionsManager, $globalFunctionsHelper, $entityFactory, $managerFactory);
    }

    /**
     * @return ODSReader
     */
    private static function createODSReader()
    {
        $optionsManager = new ODSOptionsManager();
        $helperFactory = new ODSHelperFactory();
        $managerFactory = new ODSManagerFactory();
        $entityFactory = new ODSInternalEntityFactory($helperFactory, $managerFactory);
        $globalFunctionsHelper = $helperFactory->createGlobalFunctionsHelper();

        return new ODSReader($optionsManager, $globalFunctionsHelper, $entityFactory);
    }
}
