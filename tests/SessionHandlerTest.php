<?php

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use SSSession\MainSessionHandler;

class SessionHandlerTest extends TestCase
{
    private MainSessionHandler $handler;
    
    protected function setUp(): void
    {
        $this->handler = new MainSessionHandler(new ArrayStorageHelper(['testId' => 'data']));
    }

    public function testOpen(): void
    {
        $this->assertTrue($this->handler->open('/temp', 'name'));
    }

    public function testClose(): void
    {
        $this->assertTrue($this->handler->close());   
    }

    public function testDestroy(): void
    {
        $this->assertTrue($this->handler->destroy('testId'));   
    }

    public function testGc(): void
    {
        $this->assertSame(0, $this->handler->gc(100)); 
    }

    public function testWriteRead(): void
    {
        $this->assertTrue($this->handler->write('testId', 'data:1'));
        $this->assertSame('data:1', $this->handler->read('testId'));
    }

    public function testReadInvalidId(): void
    {
        $this->assertEmpty($this->handler->read('notexisttestId'));
    }

    public function testValidateId(): void
    {
        $this->assertTrue($this->handler->validateId('testId'));
    }

    public function testValidateIdInvalidId(): void
    {
        $this->assertFalse($this->handler->validateId('notexistsId'));
    }

    public function testUpdateTimestamp(): void
    {
        $this->assertTrue($this->handler->updateTimeStamp('testId', 'data'));
    }

    public function testUpdateTimestampNotExistId(): void
    {
        $this->assertFalse($this->handler->updateTimeStamp('notexisttestId', 'data'));
    }
}
