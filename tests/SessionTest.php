<?php

namespace SSSession\UnitTest;

use LogicException;
use PHPUnit\Framework\TestCase;
use SSSession\SessionBag;

class SessionTest extends TestCase
{
    use SessionHelper;

    public function testStart(): void
    {
        $this->assertTrue($this->session->start());

        // try to start it again
        $this->assertTrue($this->session->start());
    }

    public function testStartWithInvalidId(): void
    {
        $id = 'newID1';
        $_COOKIE[\session_name()] = $id;

        $this->assertTrue($this->session->start());

        $this->assertNotSame($id, $this->session->getId());
    }

    public function testRegenerateId(): void
    {
        $this->session->start();

        $sessionId = $this->session->getId();

        $this->assertTrue($this->session->regenerateId());
    
        $this->assertNotSame($sessionId, $this->session->getId());
    }

    public function testRegenerateIdInactiveSession(): void
    {
        $this->assertFalse($this->session->regenerateId());
    }

    /** @dataProvider provideValidOptions */
    public function testSetOptions(array $options): void
    {
        $this->session->setOptions($options);
        $setting = \key($options);

        $this->assertSame($options[$setting], \ini_get("session.$setting"));
    }

    public function testSetOptionsInvalidOptions(): void
    {
        $options = [
            'dummy1' => '2',
            'auto_start' => '1',
            'serialize_handler' => '2',
        ];

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Unsupported session options: ' . \implode(', ', \array_keys($options)));
        
        $this->session->setOptions($options);
    }

    public function testClear(): void
    {
        $this->session->start();

        $this->assertTrue($this->session->clear());
    }

    public function testClearInactiveSession(): void
    {
        $this->assertFalse($this->session->clear());
    }

    public function testSave(): void
    {
        $this->session->start();

        $this->assertTrue($this->session->save());
        $this->assertSame(\PHP_SESSION_NONE, \session_status());
    }

    public function testSaveInactiveSession(): void
    {
        $this->assertSame(\PHP_SESSION_NONE, \session_status());
        $this->assertFalse($this->session->save());
    }

    public function testReadOnlySession(): void
    {
        $this->session->enableReadonly();
        $this->session->start();
        $this->assertSame(\PHP_SESSION_NONE, \session_status());
        $this->session->disableReadonly();
        $this->session->start();
        $this->assertSame(\PHP_SESSION_ACTIVE, \session_status());
    }

    public function testGetSetBag(): void
    {
        $newbag = new class extends SessionBag {};

        $this->session->setBag($newbag);
        $this->assertInstanceOf($newbag::class, $this->session->getBag());
    }

    public static function provideValidOptions(): array
    {
        return [
            [
                [
                    'name' => 'test',
                    'cookie_lifetime' => '1',
                    'cookie_path' => '/test',
                    'cookie_domain' => 'super-simple.session',
                    'cookie_secure' => '1',
                    'cookie_httponly' => '1',
                    'cookie_secure' => '1',
                    'use_strict_mode' => '1',
                    'use_cookies' => '0',
                    'use_cookies' => '0',
                    'use_only_cookies' => '0',
                    'cache_limiter' => 'private',
                    'cache_expire' => '100',
                    'sid_length' => '40',
                    'sid_bits_per_character' => '5',
                ],
            ],
        ];
    }
}
