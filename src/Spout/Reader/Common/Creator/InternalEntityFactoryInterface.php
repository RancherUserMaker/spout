<?php

namespace Rancherusermaker\Spout\Reader\Common\Creator;

use Rancherusermaker\Spout\Common\Entity\Cell;
use Rancherusermaker\Spout\Common\Entity\Row;

/**
 * Interface EntityFactoryInterface
 */
interface InternalEntityFactoryInterface
{
    /**
     * @param Cell[] $cells
     * @return Row
     */
    public function createRow(array $cells = []);

    /**
     * @param mixed $cellValue
     * @return Cell
     */
    public function createCell($cellValue);
}
