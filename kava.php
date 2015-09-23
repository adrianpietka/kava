<?php

task('build', function(Kava\Commands $commands) {
    $dirSeparator = DIRECTORY_SEPARATOR;
    $srcPath = $commands->getFullPath().'src'.$dirSeparator;
    $buildsPath = $commands->getFullPath().'builds'.$dirSeparator;
    $packageName = 'kava.phar';

    if (file_exists($buildsPath.$packageName)) {
        if (!unlink($buildsPath.$packageName)) {
            exit('Can not delete: '.$buildsPath.$packageName);
        }
    }

    $phar = new Phar($buildsPath.$packageName,
        FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME,
        $packageName);

    $phar->startBuffering();
    $phar->buildFromDirectory($srcPath, '/.php$/');
    $phar->createDefaultStub($srcPath.'index.php');
    $phar->stopBuffering();
    
    echo '> Finished build.'.PHP_EOL;
    echo '> Phar file in: '.$buildsPath.$packageName;
});

task('default', ['build']);