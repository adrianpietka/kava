<?php

namespace Kava\Command\Filesystem;

trait Manifest {
    public function fullPath($addToPath = '') {
        return (new FullPath($addToPath))->execute();
    }

    public function deleteFile($pathToFile) {
        (new DeleteFile($pathToFile))->execute();
    }
}