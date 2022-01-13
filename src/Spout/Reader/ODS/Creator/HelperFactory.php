<?php

namespace Rancherusermaker\Spout\Reader\ODS\Creator;

use Rancherusermaker\Spout\Reader\ODS\Helper\CellValueFormatter;
use Rancherusermaker\Spout\Reader\ODS\Helper\SettingsHelper;

/**
 * Class HelperFactory
 * Factory to create helpers
 */
class HelperFactory extends \Rancherusermaker\Spout\Common\Creator\HelperFactory
{
    /**
     * @param bool $shouldFormatDates Whether date/time values should be returned as PHP objects or be formatted as strings
     * @return CellValueFormatter
     */
    public function createCellValueFormatter($shouldFormatDates)
    {
        $escaper = $this->createStringsEscaper();

        return new CellValueFormatter($shouldFormatDates, $escaper);
    }

    /**
     * @param InternalEntityFactory $entityFactory
     * @return SettingsHelper
     */
    public function createSettingsHelper($entityFactory)
    {
        return new SettingsHelper($entityFactory);
    }

    /**
     * @return \Rancherusermaker\Spout\Common\Helper\Escaper\ODS
     */
    public function createStringsEscaper()
    {
        /* @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        return new \Rancherusermaker\Spout\Common\Helper\Escaper\ODS();
    }
}
