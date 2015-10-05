<?php

class TaskTest extends PHPUnit_Framework_TestCase
{
    private $name = 'Task Name';
    private $dependOn = ['task1', 'task2', 'task3'];
    private $callback;
    private $task;

    protected function setUp()
    {
        $this->callback = function () {
            return 'Return from callback';
        };

        $this->task = new Kava\Task($this->name, $this->callback, $this->dependOn);
    }

    public function invalidTaskNameProvider()
    {
        return [
            [''],
            [[]],
            [0]
        ];
    }

    public function testSetupValidTaskName()
    {
        $this->assertEquals($this->name, $this->task->name());
    }

    /**
     * @dataProvider invalidTaskNameProvider
     */
    public function testSetupInvalidTaskName($invalidTaskName)
    {
        $this->setExpectedException('InvalidArgumentException');
        new Kava\Task($invalidTaskName, $this->callback, $this->dependOn);
    }

    public function testSetupCallback()
    {
        $this->assertEquals(call_user_func_array($this->callback, []), $this->task->execute());
    }
}
