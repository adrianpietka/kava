<?php

namespace Kava;

class Task { 
    private $name;
    private $dependOn;
    private $content;

    private function guard($name) {
        if (!is_string($name) || !trim($name)) {
            throw new \InvalidArgumentException('Task name must be a string and can\'t be empty.');
        }
    }

    public function __construct($name, \Closure $content, array $dependOn = []) {
        $this->guard($name);

        $this->name = $name;
        $this->content = $content;
        $this->dependOn = $dependOn;
    }
    
    public function name() {
        return $this->name;
    }
    
    public function dependOn() {
        return $this->dependOn;
    }
    
    public function execute() {
        return call_user_func_array($this->content, []);
    }
}