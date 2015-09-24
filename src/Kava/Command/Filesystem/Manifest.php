<?php

namespace Kava\Command\Filesystem;

trait Manifest {
    public function fullPath($addToPath = '') {
        return (new FullPath($addToPath))->execute();
    }
}