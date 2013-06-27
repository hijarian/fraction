# JB TDD training exercise 1
## Fractions

This is the example library to test-drive our skills in TDD.

The goal is to make a library to handle the rational numbers exactly, i. e. work with numbers like 2/3, 34/19 and the like.
Set of operations to be supported is adding, subtracting, multiplying and dividing.

Code is PHP conforming to [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
and has a test suite based on [PHPUnit](http://phpunit.de).

Testsuite is to be run like this:

    cd $PROJECT_ROOT_DIR
    phpunit

## Running tests with the Composer-installed PHPUnit.

First, [get the Composer binary](http://getcomposer.org/download/):

    cd $PROJECT_ROOT_DIR
    curl -sS https://getcomposer.org/installer | php

Second run it to install PHPUnit, all necessary configs already there in `composer.json` file:

    php composer.phar install

Second, run the PHPUnit as follows (you basically use different binary here):

    cd $PROJECT_ROOT_DIR
    vendor/bin/phpunit

This will launch a completely sandboxed PHPUnit, which is hopefully more stable than using systemwide PHPUnit.
Please note, that `composer.json` is a generic definition of what is required for this project.
[`composer.lock`](http://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file) fixes the exact versions of PHPUnit and all it's dependencies as they were on my particular workstation
at the time of writing so all of you who will install PHPUnit using my `composer.lock` will get the same PHPUnit as me.
Which is working, that is. :)
