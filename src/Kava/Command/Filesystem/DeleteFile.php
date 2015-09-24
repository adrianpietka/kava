<?php

namespace Kava\Command\Filesystem;

use Kava\Exception;
use Kava\Contracts\Command as CommandContract;

class DeleteFile implements CommandContract {
    private $pathToFile;

    public function __construct($pathToFile) {
        $this->pathToFile = $pathToFile;
    }

    public function execute() {
        if (file_exists($this->pathToFile)) {
            if (!unlink($this->pathToFile)) {
                throw new Exception('Can not delete: '.$this->pathToFile);
            }
        }
    }
}