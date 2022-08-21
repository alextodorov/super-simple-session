<?php

namespace SSSession\UnitTest;

use SSSession\MainSessionHandler;
use SSSession\Session;

trait SessionHelper
{
    private ?Session $session;

    protected function setUp(): void
    {
        $this->session = new Session();

        $handler = new MainSessionHandler(new ArrayStorageHelper());

        \session_set_save_handler($handler);
    }

    protected function tearDown(): void
    {
        $this->session = null;

        if (\session_status() === \PHP_SESSION_ACTIVE) {
            \session_destroy();
        }
    }
}
