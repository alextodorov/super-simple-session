<?php

namespace SSSession\UnitTest;

use SSSession\SessionStoragableInterface;

class ArrayStorageHelper implements SessionStoragableInterface
{
    public function __construct(private array $storage = [])
    {    
    }

    public function write(string $id, string $value): bool
    {
        $this->storage[$id] = $value;

        return true;
    }

    public function read(string $id): string
    {
        return $this->storage[$id] ?? '';
    }

    public function clear(string $id): bool
    {
        unset($this->storage[$id]);

        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function updateTimeStamp(string $id, string $data): bool
    {
        return isset($this->storage[$id]);
    }
}
