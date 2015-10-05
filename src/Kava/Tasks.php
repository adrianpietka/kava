<?php

namespace Kava;

class Tasks
{
    private $tasks = [];
    
    public function add(Task $task)
    {
        if (!$this->hasUniqueTaskName($task->name())) {
            throw new Exception(sprintf('Task name (%s) is not unique!', $task->name()));
        }

        $this->tasks[] = $task;
    }
    
    public function all()
    {
        return $this->tasks;
    }

    public function hasUniqueTaskName($taskName)
    {
        foreach ($this->tasks as $task) {
            if ($task->name() === $taskName) {
                return false;
            }
        }

        return true;
    }
    
    public function get($taskName)
    {
        foreach ($this->tasks as $task) {
            if ($task->name() === $taskName) {
                return $task;
            }
        }
        
        throw new Exception(sprintf('Task %s does not exist!', $taskName));
    }
}
