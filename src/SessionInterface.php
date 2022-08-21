<?php

namespace SSSession;

interface SessionInterface
{
    public function start(): bool;

    public function clear(): bool;

    public function regenerateId(): bool;

    public function setOptions(array $options): void;

    public function save(): bool;
}
