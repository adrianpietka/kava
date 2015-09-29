# KAVA

[![Build Status](https://travis-ci.org/adrianpietka/kava.svg?branch=master)](https://travis-ci.org/adrianpietka/kava)

Task runner for PHP.

**Proof of Concept**. PoC code was wrote in 90 minutes.

Do you like it? Please add a star, fork it or create pull requests!

Current version: 0.1

## Install Kava

```
$: git clone git@github.com:adrianpietka/kava.git kava-src
$: cd kava-src
$: php src/index.php build
```

If you have older version of Kava then can build it using Kava task:

```
$: kava build
```

## Getting started

```
$: cd /c/projects/myproject
$: touch kava.php

$: kava [taskName]
$: kava hello
```

## Example content of *kava.php*

```php
$commands = new Kava\Commands();

task('hello', function() {
    echo 'Hello World form Kava!'.PHP_EOL;
});

task('super', ['hello'], function() use ($commands) {
    echo 'Default task (super)'.PHP_EOL;
    echo $commands->fullPath().PHP_EOL;
});

defaultTask('super');
```

```
$: kava
Hello World form Kava!
Default task (super)
C:\Projects\myproject
```

## Author

Adrian Pietka

- [http://adrian.pietka.me](http://adrian.pietka.me)
- [adrian@pietka.me](mailto:adrian@pietka.me)