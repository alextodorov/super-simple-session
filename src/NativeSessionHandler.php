<?php

namespace SSSession;

use LogicException;
use RuntimeException;
use SessionHandler;

class NativeSessionHandler extends SessionHandler
{
    public function __construct(private string $path = '')
    {
        if ($path === '') {
            $path = \ini_get('session.save_path');
        }

        if (\substr_count($path, ';') > 0) {
            $path = \trim(\strrchr($path, ';'), ';');
        }

        $sessionDir = $path;

        \set_error_handler(function ($type, $msg) {
            if ($type === \E_WARNING) {
                throw new RuntimeException($msg);
            }

            return true;
        });

        try {
            if (! \is_dir($sessionDir) && ! \mkdir($sessionDir, 0770, true)) {
                throw new LogicException('Cannot create session directory: ' . $sessionDir);
            }
        } finally {
            \restore_error_handler();
        }

        \ini_set('session.save_path', $path);
    }
}
