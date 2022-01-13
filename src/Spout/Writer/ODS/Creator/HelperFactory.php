<?php

namespace Rancherusermaker\Spout\Writer\ODS\Creator;

use Rancherusermaker\Spout\Common\Helper\Escaper;
use Rancherusermaker\Spout\Common\Helper\StringHelper;
use Rancherusermaker\Spout\Common\Manager\OptionsManagerInterface;
use Rancherusermaker\Spout\Writer\Common\Creator\InternalEntityFactory;
use Rancherusermaker\Spout\Writer\Common\Entity\Options;
use Rancherusermaker\Spout\Writer\Common\Helper\ZipHelper;
use Rancherusermaker\Spout\Writer\ODS\Helper\FileSystemHelper;

/**
 * Class HelperFactory
 * Factory for helpers needed by the ODS Writer
 */
class HelperFactory extends \Rancherusermaker\Spout\Common\Creator\HelperFactory
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @param InternalEntityFactory $entityFactory
     * @return FileSystemHelper
     */
    public function createSpecificFileSystemHelper(OptionsManagerInterface $optionsManager, InternalEntityFactory $entityFactory)
    {
        $tempFolder = $optionsManager->getOption(Options::TEMP_FOLDER);
        $zipHelper = $this->createZipHelper($entityFactory);

        return new FileSystemHelper($tempFolder, $zipHelper);
    }

    /**
     * @param $entityFactory
     * @return ZipHelper
     */
    private function createZipHelper($entityFactory)
    {
        return new ZipHelper($entityFactory);
    }

    /**
     * @return Escaper\ODS
     */
    public function createStringsEscaper()
    {
        return new Escaper\ODS();
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
