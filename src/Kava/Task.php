<?php

namespace Kava;

class Task { 
    private $name;
    private $dependOn;
    private $content;
    
    public function __construct($name, \Closure $content, array $dependOn = []) {
        if (!is_string($name) || trim($name)) {
            throw new Exception('Task name must be a string and can\'t be empty.');
        }

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
        call_user_func_array($this->content, []);
    }
}