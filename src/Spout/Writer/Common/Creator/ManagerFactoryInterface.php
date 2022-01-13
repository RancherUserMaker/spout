<?php

namespace Rancherusermaker\Spout\Writer\Common\Creator;

use Rancherusermaker\Spout\Common\Manager\OptionsManagerInterface;
use Rancherusermaker\Spout\Writer\Common\Manager\SheetManager;
use Rancherusermaker\Spout\Writer\Common\Manager\WorkbookManagerInterface;

/**
 * Interface ManagerFactoryInterface
 */
interface ManagerFactoryInterface
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @return WorkbookManagerInterface
     */
    public function createWorkbookManager(OptionsManagerInterface $optionsManager);

    /**
     * @return SheetManager
     */
    public function createSheetManager();
}
