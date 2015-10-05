<?php

namespace Kava\Command\Filesystem;

use Kava\Contract\Command as CommandContract;

class FullPath implements CommandContract
{
    private $addToPath;

    public function __construct($addToPath = '')
    {
        $this->addToPath = $addToPath  ? str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $addToPath) : '';
    }

    public function execute()
    {
        $addToPath = trim($this->addToPath, DIRECTORY_SEPARATOR);
        
        return join(DIRECTORY_SEPARATOR, array(getcwd(), $addToPath)).DIRECTORY_SEPARATOR;
    }
}
