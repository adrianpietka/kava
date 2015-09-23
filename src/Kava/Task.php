<?php

namespace Kava;

class Task { 
    private $name;
    private $dependOn;
    private $content;
    private $commands;
    
    public function __construct(Commands $commands, $name, \Closure $content, array $dependOn = []) {
        $this->commands = $commands;
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
        call_user_func_array($this->content, [$this->commands]);
    }
}