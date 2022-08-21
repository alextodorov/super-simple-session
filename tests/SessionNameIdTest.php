<?php

namespace SSSession\UnitTest;

use LogicException;
use PHPUnit\Framework\TestCase;

class SessionNameIdTest extends TestCase
{
    use SessionHelper;

    public function testSessionName(): void
    {
        $this->session->setName('MySession');

        $this->assertSame('MySession', $this->session->getName());
    }

    public function testSessionId(): void
    {
        $this->session->start();

        $this->assertNotEmpty($this->session->getId());
    }

    public function testSetNameAfterSessionStarted(): void
    {
        $this->session->start();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Can\'t change the session name. The session has been started.');
        
        $this->session->setName('testName');
    }
}
