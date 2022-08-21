<?php

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use SSSession\SessionFactory;
use SSSession\SessionInterface;

class SessionFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory =  new SessionFactory();
        $handler = $this->createMock(\SessionHandler::class);

        $this->assertInstanceOf(SessionInterface::class, $factory->create($handler, []));
    }
}
