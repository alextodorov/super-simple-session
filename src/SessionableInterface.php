<?php

namespace SSSession;

interface SessionableInterface
{
    public function start(): bool;

    public function clear(): bool;

    public function regenerateId(): bool;

    public function setOptions(array $options): void;

    public function save(): bool;
}
