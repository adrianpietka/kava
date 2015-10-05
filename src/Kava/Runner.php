<?php

namespace Kava;

class Runner
{
    private $tasks;
    private $taskToExecute;
    private $defaultTask = 'default';
    
    public function __construct(Tasks $tasks, $taskToExecute = null)
    {
        $this->tasks = $tasks;
        $this->taskToExecute = $taskToExecute;
    }
    
    public function defaultTask($taskName)
    {
        $this->defaultTask = $taskName;
    }
    
    public function execute()
    {
        $taskToExecute = $this->taskToExecute ? $this->taskToExecute : $this->defaultTask;
        $task = $this->tasks->get($taskToExecute);
        
        $this->executeTask($task);
    }
    
    protected function executeTask($task)
    {
        $dependencies = $task->dependOn();
        
        foreach ($dependencies as $depend) {
            $this->executeTask($this->tasks->get($depend));
        }
        
        $task->execute();
    }
}
