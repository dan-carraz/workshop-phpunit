Workshop PHPunit
================

# Installation

First, clone this repository:

```bash
$ git clone https://github.com/fpondepeyre/workshop-phpunit.git
```
Then, run:

```bash
$ docker-compose up
```

Enter in the "app" container:
```bash
$ docker-compose run app bash
$ composer install
```

Run tests:
```bash
$ ./bin/phpunit
```

## Indroduction to PHPUnit - First test

If phpunit is not installed

```bash
composer req test
```

Setup phpunit.xml.dist file, by example:

```xml
<?xml version="1.0" encoding="UTF-8"?>

<!-- https://phpunit.de/manual/current/en/appendixes.configuration.html -->
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="http://schema.phpunit.de/6.5/phpunit.xsd"
         backupGlobals="false"
         colors="true"
         bootstrap="vendor/autoload.php"
>
    <php>
        <ini name="error_reporting" value="-1" />
        <env name="KERNEL_CLASS" value="App\Kernel" />
        <env name="APP_ENV" value="test" />
        <env name="APP_DEBUG" value="1" />
        <env name="APP_SECRET" value="s$cretf0rt3st" />
        <env name="SHELL_VERBOSITY" value="-1" />
    </php>

    <testsuites>
        <testsuite name="Project Test Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>src</directory>
        </whitelist>
    </filter>

    <listeners>
        <listener class="Symfony\Bridge\PhpUnit\SymfonyTestsListener" />
    </listeners>
</phpunit>
```

- Your tests should mirror your codebase directly but within its own folder, and test files must match the file they are testing, with Test appended. In our example, if we had the following code
- Classnames are exactly the same as filenames. Whatever you have named your file should be the name of your class - which should be true for your non-test code anyway!
- Your test method names should start with test, in lower case. Method names should be descriptive of what is being tested, and should include the name of the method being tested. This is not a place for short, abbreviated method names.
- PHPUnit is unable to run tests that are either protected or private - they must be public. Likewise, any methods you create as helpers must be public. We are not building a public API here, we just want to write tests so do not worry about visibility.
- Your classes must extend the TestCase class, or extend a class that does.

First stupid test:

```php
<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class StupidTest
 */
class StupidTest extends TestCase
{
    public function testTrueIsTrue()
    {
        $foo = true;
        $this->assertTrue($foo);
    }
}
```

## Assertions, Writing a Useful Test

List of assertions: https://phpunit.readthedocs.io/en/7.4/assertions.html

First test.

```php
class SlugTest extends TestCase
{
    public function testSluggifyReturnsSluggifiedString()
    {
        $originalString = 'This string will be sluggified';
        $expectedResult = 'this-string-will-be-sluggified';

        $slug = new Slug();

        $result = $slug->sluggify($originalString);

        $this->assertSame($expectedResult, $result);
    }
```

Avoid duplication code

```php
<?php
// ...

/**
 * @dataProvider providerTestFoo
 */
public function testFoo($variableOne, $variableTwo)
{
    //
}

public function providerTestFoo()
{
    return array(
        array('test 1, variable one', 'test 1, variable two'),
        array('test 2, variable one', 'test 2, variable two'),
        array('test 3, variable one', 'test 3, variable two'),
        array('test 4, variable one', 'test 4, variable two'),
        array('test 5, variable one', 'test 5, variable two'),
    );
}
```