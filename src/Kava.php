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

class Commands {
    public function getFullPath() {
        return getcwd();
    }
}

class Exception extends \Exception {
    
}

$currentDir = getcwd();
$taskToExecute = isset($argv[1]) ? $argv[1] : null;

$tasks = new Tasks;
$commands = new Commands;
$runner = new Runner($tasks, $taskToExecute);

include_once __DIR__.DIRECTORY_SEPARATOR.'Helpers.php';

try {
    if (!file_exists($currentDir.DIRECTORY_SEPARATOR.'kava.php')) {
        throw new Exception(sprintf("Configuration file of Kava (kava.php) does not exist in current path: \n> %s", $currentDir));
    }
    
    include_once $currentDir.DIRECTORY_SEPARATOR.'kava.php';

    $runner->execute();   
} catch(Exception $e) {
    echo $e->getMessage();
}