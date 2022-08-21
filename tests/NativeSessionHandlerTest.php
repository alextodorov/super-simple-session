<?php

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use SSSession\NativeSessionHandler;

class NativeSessionHandlerTest extends TestCase
{
    public function testCreationOfSessionDir(): void
    {
        $path = __DIR__ . 'session';

        new NativeSessionHandler('2;' . $path);
        $this->assertDirectoryExists($path);

        \rmdir($path);
    }
    
    public function testCreationOfSessionDefaultDir(): void
    {
        \ini_set('session.save_path', __DIR__ . 'tmp');

        new NativeSessionHandler();
        $this->assertDirectoryExists(__DIR__ . 'tmp');

        \rmdir(__DIR__ . 'tmp');
    }
}
