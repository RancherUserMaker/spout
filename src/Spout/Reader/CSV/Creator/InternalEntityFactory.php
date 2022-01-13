<?php

namespace Rancherusermaker\Spout\Reader\CSV\Creator;

use Rancherusermaker\Spout\Common\Creator\HelperFactory;
use Rancherusermaker\Spout\Common\Entity\Cell;
use Rancherusermaker\Spout\Common\Entity\Row;
use Rancherusermaker\Spout\Common\Helper\GlobalFunctionsHelper;
use Rancherusermaker\Spout\Common\Manager\OptionsManagerInterface;
use Rancherusermaker\Spout\Reader\Common\Creator\InternalEntityFactoryInterface;
use Rancherusermaker\Spout\Reader\CSV\RowIterator;
use Rancherusermaker\Spout\Reader\CSV\Sheet;
use Rancherusermaker\Spout\Reader\CSV\SheetIterator;

/**
 * Class EntityFactory
 * Factory to create entities
 */
class InternalEntityFactory implements InternalEntityFactoryInterface
{
    /** @var HelperFactory */
    private $helperFactory;

    /**
     * @param HelperFactory $helperFactory
     */
    public function __construct(HelperFactory $helperFactory)
    {
        $this->helperFactory = $helperFactory;
    }

    /**
     * @param resource $filePointer Pointer to the CSV file to read
     * @param OptionsManagerInterface $optionsManager
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return SheetIterator
     */
    public function createSheetIterator($filePointer, $optionsManager, $globalFunctionsHelper)
    {
        $rowIterator = $this->createRowIterator($filePointer, $optionsManager, $globalFunctionsHelper);
        $sheet = $this->createSheet($rowIterator);

        return new SheetIterator($sheet);
    }

    /**
     * @param RowIterator $rowIterator
     * @return Sheet
     */
    private function createSheet($rowIterator)
    {
        return new Sheet($rowIterator);
    }

    /**
     * @param resource $filePointer Pointer to the CSV file to read
     * @param OptionsManagerInterface $optionsManager
     * @param GlobalFunctionsHelper $globalFunctionsHelper
     * @return RowIterator
     */
    private function createRowIterator($filePointer, $optionsManager, $globalFunctionsHelper)
    {
        $encodingHelper = $this->helperFactory->createEncodingHelper($globalFunctionsHelper);

        return new RowIterator($filePointer, $optionsManager, $encodingHelper, $this, $globalFunctionsHelper);
    }

    /**
     * @param Cell[] $cells
     * @return Row
     */
    public function createRow(array $cells = [])
    {
        return new Row($cells, null);
    }

    /**
     * @param mixed $cellValue
     * @return Cell
     */
    public function createCell($cellValue)
    {
        return new Cell($cellValue);
    }

    /**
     * @param array $cellValues
     * @return Row
     */
    public function createRowFromArray(array $cellValues = [])
    {
        $cells = \array_map(function ($cellValue) {
            return $this->createCell($cellValue);
        }, $cellValues);

        return $this->createRow($cells);
    }
}
