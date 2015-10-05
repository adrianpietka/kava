<?php

$commands = new Kava\Commands();

task('build', function () use ($commands) {
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

task('code-fixer', function() use ($commands) {
    echo $commands->exec('php-cs-fixer fix ./ --level=psr2');
});

task('tests', function () use ($commands) {
    echo $commands->exec('phpunit --configuration=tests/phpunit.xml --testdox');
});

task('default', ['build']);
