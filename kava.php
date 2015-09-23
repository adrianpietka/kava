<?php

task('hello', function() {
    echo 'Hello World form Kava!'.PHP_EOL;
});

task('super', ['hello'], function(Kava\Commands $commands) {
    echo 'Default task (super)'.PHP_EOL;
    echo $commands->getFullPath().PHP_EOL;
});

defaultTask('super');