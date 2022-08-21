<?php

namespace SSSession;

use SessionHandlerInterface;
use SessionUpdateTimestampHandlerInterface;

class MainSessionHandler implements SessionHandlerInterface, SessionUpdateTimestampHandlerInterface
{
    public function __construct(private SessionStorageInterface $storage)
    {
    }

    public function open(string $path, string $name): bool
    {
        return true;   
    }

    public function read(string $id): string|false
    {
        return $this->storage->read($id);   
    }

    public function write(string $id, string $data): bool
    {
        return $this->storage->write($id, $data);
    }

    public function close(): bool
    {
        return $this->storage->close();
    }

    public function gc(int $maxLifetime): int|false
    {
        return 0;
    }

    public function destroy(string $id): bool
    {
        return $this->storage->clear($id);
    }

    public function validateId(string $id): bool
    {
        return $this->storage->read($id) !== '';
    }

    public function updateTimestamp(string $id, string $data): bool
    {
        return $this->storage->updateTimeStamp($id, $data);
    }
}
