<?php

$commands = new Kava\Commands();

task('build', function() use ($commands) {
    $packageName = 'kava.phar';
    $srcPath = $commands->fullPath('src');
    $buildsPath = $commands->fullPath('builds');
    $pharPath = $buildsPath.$packageName;

    $commands->deleteFile($pharPath);

    $phar = new Phar($pharPath);
    $phar->startBuffering();
    $phar->buildFromDirectory($srcPath, '/.php$/');
    $phar->createDefaultStub($srcPath.'index.php');
    $phar->stopBuffering();
    
    echo '> Finished build.'.PHP_EOL;
    echo '> Phar file in: '.$pharPath;
});

task('tests', function() use ($commands) {
    echo $commands->exec('phpunit --version');
});

task('default', ['build']);