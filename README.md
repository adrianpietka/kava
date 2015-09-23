# KAVA

Task runner in PHP.

**Proof of Concept**. Code was wrote in 90 minutes.

## Getting started

```
$: git clone git@github.com:adrianpietka/kava.git
```

Create alias. For MINGW3: create *kava* file in *C:/Windows/System32*, with content:

```
"/c/php/php.exe" "/c/projects/kava/src/Kava.php" $*
```

Now you can use it:

```
$: cd /c/projects/myproject
$: touch kava.php
$: kava [taskName]

$: kava hello
```

## Example content of *kava.php*

```php
task('hello', function() {
    echo 'Hello World form Kava!'.PHP_EOL;
});

task('super', ['hello'], function(Kava\Commands $commands) {
    echo 'Default task (super)'.PHP_EOL;
    echo $commands->getFullPath().PHP_EOL;
});

defaultTask('super');
```

```
$: kava
Hello World form Kava!
Default task (super)
C:\Projects\myproject
```