<?php

namespace SSSession;

class SessionBag implements SessionValuableInterface
{
    private array $values = [];

    public function set(string $key, mixed $value): void
    {
        $this->values[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? false;
    }

    public function has(string $key): bool
    {
        return isset($this->values[$key]);
    }

    public function remove(string $key): void
    {
        unset($this->values[$key]);
    }

    public function initValues(): void
    {
        unset($this->values);
        $this->values = & $_SESSION;
    }
}
