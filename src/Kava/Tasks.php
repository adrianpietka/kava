<?php

namespace Kava;

class Tasks {
    private $tasks = [];
    
    public function add(Task $task) {
        $this->tasks[] = $task;
    }
    
    public function all() {
        return $this->tasks;
    }
    
    public function get($taskName) {
        foreach($this->tasks as $task) {
            if ($task->name() === $taskName) {
                return $task;
            }
        }
        
        throw new Exception(sprintf('Task %s does not exist!', $taskName));
    }
}