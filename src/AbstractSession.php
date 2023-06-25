<?php

namespace SSSession;

use LogicException;

abstract class AbstractSession
{
    protected bool $readonly = false;

    public function enableReadOnly(): void
    {
        $this->readonly = true;
    }

    public function disableReadonly(): void
    {
        $this->readonly = false;
    }

    public function setName(string $name): void
    {
        if (\session_status() === \PHP_SESSION_ACTIVE) {
            throw new LogicException('Can\'t change the session name. The session has been started.');
        }

        \session_name($name);
    }

    public function getName(): string
    {
        return \session_name();
    }

    public function getId(): string
    {
        return \session_id();
    }
}
