<?php

namespace SSSession;

interface SessionStorageInterface
{
    public function read(string $id): string;

    public function write(string $id, string $value): bool;

    public function clear(string $id): bool;

    public function close(): bool;

    public function updateTimeStamp(string $id, string $data): bool;
}
