<?php

namespace Rancherusermaker\Spout\Writer\Exception\Border;

use Rancherusermaker\Spout\Common\Entity\Style\BorderPart;
use Rancherusermaker\Spout\Writer\Exception\WriterException;

class InvalidStyleException extends WriterException
{
    public function __construct($name)
    {
        $msg = '%s is not a valid style identifier for a border. Valid identifiers are: %s.';

        parent::__construct(\sprintf($msg, $name, \implode(',', BorderPart::getAllowedStyles())));
    }
}
