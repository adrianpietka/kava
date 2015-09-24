<?php

namespace Kava\Command\Os;

use \Kava\Contracts\Command as CommandContract;

class Exec implements CommandContract {
    private $command;

    public function __construct($command) {
        $this->command = $command;
    }

    public function execute() {
        return shell_exec($this->command);
    }
}