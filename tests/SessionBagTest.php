<?php

declare(strict_types=1);

namespace SSSession\UnitTest;

use PHPUnit\Framework\TestCase;
use stdClass;

class SessionBagTest extends TestCase
{
    use SessionHelper;

    /** @dataProvider provideValidValues */
    public function testSetGetValue(string $key, mixed $value): void
    {
        $this->session->getBag()->set($key, $value);

        $this->assertSame($value, $this->session->getBag()->get($key));
    }

    public function testNotExistingValue(): void
    {
        $this->assertFalse($this->session->getBag()->get('notExist'));
    }

    public function testRemoveValue(): void
    {
        $this->session->getBag()->set('toRemove', 'test');
        $this->session->getBag()->remove('toRemove');

        $this->assertFalse($this->session->getBag()->get('toRemove'));
    }

    public function testHasValue(): void
    {
        $this->session->getBag()->set('newKey', 'newValue');

        $this->assertTrue($this->session->getBag()->has('newKey'));
        $this->assertFalse($this->session->getBag()->has('notexists'));
    }

    public static function provideValidValues(): array
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
