<?php

task('hello', function() {
    echo 'Hello World form Kava!'.PHP_EOL;
});

task('super', ['hello'], function() {
    echo 'Default task (super)'.PHP_EOL;
});

defaultTask('super');