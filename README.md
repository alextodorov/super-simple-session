# Super Simple Session
A super simple session manager.

![Build Status](https://github.com/alextodorov/super-simple-session/actions/workflows/build.yml/badge.svg?branch=main)

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

$session = (new SessionFactory())->create(\SessionHandler), []);

$session->start();
```

For more details check out the [wiki].

[wiki]: https://github.com/alextodorov/super-simple-session/wiki