# Super Simple Session
A super simple session manager.

![Build Status](https://github.com/alextodorov/super-simple-session/actions/workflows/build.yml/badge.svg?branch=main) [![codecov](https://codecov.io/gh/alextodorov/super-simple-session/branch/main/graph/badge.svg?token=4RUNRVHM2L)](https://codecov.io/gh/alextodorov/super-simple-session) [![Latest Stable Version](http://poser.pugx.org/super-simple/session/v)](https://packagist.org/packages/super-simple/session) [![PHP Version Require](http://poser.pugx.org/super-simple/session/require/php)](https://packagist.org/packages/super-simple/session) [![License](http://poser.pugx.org/super-simple/session/license)](https://packagist.org/packages/super-simple/session) [![Total Downloads](http://poser.pugx.org/super-simple/session/downloads)](https://packagist.org/packages/super-simple/session)

Install
-------

```sh
composer require super-simple/session
```

Requires PHP 8.1 or newer.

Usage
-----

Basic usage:

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SSSession\SessionFactory;

$session = (new SessionFactory())->create(new MainSessionHandler(new YourStorage()), []);

$session->start();
```

It could be use with the default php session handler.

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SSSession\SessionFactory;

$session = (new SessionFactory())->create(new \SessionHandler(), []);

$session->start();
```

For more details check out the [wiki].

[wiki]: https://github.com/alextodorov/super-simple-session/wiki