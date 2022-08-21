<?php

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use SSSession\NativeSessionHandler;

class NativeSessionHandlerTest extends TestCase
{
    protected function tearDown(): void
    {
        if (\is_dir(__DIR__ . '/tmpnoaccess')) {
            \rmdir(__DIR__ . '/tmpnoaccess');
        }    
    }

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

    public function testDirWithNoAccess(): void
    {
        $dir = __DIR__ . '/tmpnoaccess';
        \mkdir($dir, 0100);

        $this->expectException(RuntimeException::class);

        new NativeSessionHandler($dir . '/session');
    }
}
