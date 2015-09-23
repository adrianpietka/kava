<?php

namespace Kava;

class Commands {
    public function getFullPath() {
        return getcwd().DIRECTORY_SEPARATOR;
    }
}
