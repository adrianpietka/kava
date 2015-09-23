<?php

function task($taskName) {
    global $tasks; // @todo holy shit!
    
    $args = func_get_args();
    $dependencies = isset($args[1]) && is_array($args[1])
        ? $args[1]
        : [];
        
    $content = isset($args[1]) && is_callable($args[1])
        ? $args[1]
        : (isset($args[2]) && is_callable($args[2]) ? $args[2] : function() {});
    
    $task = new Kava\Task($taskName, $dependencies, $content);
    $tasks->add($task);
}

function defaultTask($taskName) {
    global $kava; // @todo holy shit!
    
    $kava->defaultTask($taskName);
}