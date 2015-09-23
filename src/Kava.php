<?php

namespace Kava;

class Task { 
    private $name;
    private $dependOn;
    private $content;
    
    public function __construct($name, array $dependOn, \Closure $content) {
        $this->name = $name;
        $this->dependOn = $dependOn;
        $this->content = $content;
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

class Exception extends \Exception {
    
}

$currentDir = getcwd();
$taskToExecute = isset($argv[1]) ? $argv[1] : null;

$tasks = new Tasks;
$kava = new Runner($tasks, $taskToExecute);

include_once __DIR__.DIRECTORY_SEPARATOR.'Helpers.php';

try {
    if (!file_exists($currentDir.DIRECTORY_SEPARATOR.'kava.php')) {
        throw new Exception(sprintf("Configuration file of Kava (kava.php) does not exist in current path: \n> %s", $currentDir));
    }
    
    include_once $currentDir.DIRECTORY_SEPARATOR.'kava.php';

    $kava->execute();   
} catch(Exception $e) {
    echo $e->getMessage();
}