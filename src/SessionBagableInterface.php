<?php

namespace SSSession;

interface SessionBagableInterface
{
    public function setBag(SessionValuableInterface $bag): void;

    public function getBag(): SessionValuableInterface;
}
