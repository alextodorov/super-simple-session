<?php

namespace SSSession;

use SessionHandlerInterface;

class SessionFactory
{
    public function create(SessionHandlerInterface $handler, array $options): SessionInterface
    {
        \session_register_shutdown();

        \session_set_save_handler($handler);

        $session = new Session();
        $session->setOptions($options);

        return $session;
    }
}
