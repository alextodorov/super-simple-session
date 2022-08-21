<?php

declare(strict_types=1);

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use stdClass;

class SessionValueTest extends TestCase
{
    use SessionHelper;

    /** @dataProvider provideValidValues */
    public function testSetGetValue(string $key, mixed $value): void
    {
        $this->session->set($key, $value);

        $this->assertSame($value, $this->session->get($key));
    }

    public function testNotExistingValue(): void
    {
        $this->assertFalse($this->session->get('notExist'));
    }

    public function testRemoveValue(): void
    {
        $this->session->set('toRemove', 'test');
        $this->session->remove('toRemove');

        $this->assertFalse($this->session->get('toRemove'));
    }

    public function testHasValue(): void
    {
        $this->session->set('newKey', 'newValue');

        $this->assertTrue($this->session->has('newKey'));
        $this->assertFalse($this->session->has('notexists'));
    }

    public function provideValidValues(): array
    {
        return [
            [
                'stringTest',
                'stringValue',
            ],
            [
                'intTest',
                45,
            ],
            [
                'arrayTest',
                [12],
            ],
            [
                'objectTest',
                [new stdClass],
            ],
        ];
    }
}
