<?php

// @todo Add autoload
include_once 'Kava/Contracts/Command.php';

include_once 'Kava/Command/Filesystem/FullPath.php';
include_once 'Kava/Command/Filesystem/Manifest.php';

include_once 'Kava/Command/Os/Exec.php';
include_once 'Kava/Command/Os/Manifest.php';

include_once 'Kava/Commands.php';
include_once 'Kava/Exception.php';
include_once 'Kava/Runner.php';
include_once 'Kava/Tasks.php';
include_once 'Kava/Task.php';
include_once 'Kava/Aliases.php';

$currentDir = getcwd();
$taskToExecute = isset($argv[1]) ? $argv[1] : null;

$tasks = new Kava\Tasks;
$commands = new Kava\Commands;
$runner = new Kava\Runner($tasks, $taskToExecute);

try {
    if (!file_exists($currentDir.DIRECTORY_SEPARATOR.'kava.php')) {
        throw new Kava\Exception(sprintf("Configuration file of Kava (kava.php) does not exist in current path: \n> %s", $currentDir));
    }
    
    include_once $currentDir.DIRECTORY_SEPARATOR.'kava.php';

    $runner->execute();   
} catch(Kava\Exception $e) {
    echo $e->getMessage();
}