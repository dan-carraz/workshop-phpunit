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