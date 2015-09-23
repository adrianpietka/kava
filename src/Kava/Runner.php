<?php

namespace Kava;

class Runner {
    private $tasks;
    private $taskToExecute;
    private $defaultTask = 'default';
    
    public function __construct(Tasks $tasks, $taskToExecute = null) {
        $this->tasks = $tasks;
        $this->taskToExecute = $taskToExecute;
    }
    
    public function defaultTask($taskName) {
        $this->defaultTask = $taskName;
    }
    
    public function execute() {
        $taskToExecute = $this->taskToExecute ? $this->taskToExecute : $this->defaultTask;
        $task = $this->tasks->get($taskToExecute);
        
        $this->_execute_task($task);
    }
    
    protected function _execute_task($task) {
        $dependencies = $task->dependOn();
        
        foreach ($dependencies as $depend) {
            $this->_execute_task($this->tasks->get($depend));
        }
        
        $task->execute();
    }
}