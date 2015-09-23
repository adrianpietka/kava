<?php

namespace Kava;

class Commands {
    public function getFullPath() {
        return getcwd().DIRECTORY_SEPARATOR;
    }
    
    public function exec($command) {
        return shell_exec($command);
    }
}
