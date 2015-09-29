<?php

class TasksTest extends PHPUnit_Framework_TestCase {
    private $tasks;

    protected function setUp() {
        $this->tasks = new Kava\Tasks;
    }

    public function testAddTwoUniqueTasks() {
        $firstTask = new Kava\Task('first task', function() {});
        $secondTask = new Kava\Task('second task', function() {});

        $this->tasks->add($firstTask);
        $this->tasks->add($secondTask);

        $this->assertEquals(count($this->tasks->all()), 2);
    }

    public function testCantAddTaskWithTheSameName() {
        $task = new Kava\Task('first task', function() {});

        $this->setExpectedException('Kava\Exception');

        $this->tasks->add(clone $task);
        $this->tasks->add(clone $task);
    }

    public function testGetExistTaskByName() {
        $taskName = 'first task';
        $task = new Kava\Task($taskName, function() {});

        $this->tasks->add($task);

        $this->assertEquals($task, $this->tasks->get($taskName));
    }

    public function testCantGetNotExistTaskByName() {
        $this->setExpectedException('Kava\Exception');

        $this->tasks->get('not exist task name');
    }
}