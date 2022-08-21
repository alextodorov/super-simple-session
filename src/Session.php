<?php

declare(strict_types=1);

namespace SSSession;

use LogicException;

class Session extends AbstractSession implements SessionInterface, SessionValueInterface
{
    use SessionValue;

    public const OPTIONS_PREFIX = 'session';

    public const SUPPORTED_OPTIONS = [
        'name',
        'cookie_lifetime',
        'cookie_path',
        'cookie_domain',
        'cookie_secure',
        'cookie_httponly',
        'cookie_secure',
        'use_strict_mode',
        'use_cookies',
        'use_cookies',
        'use_only_cookies',
        'cache_limiter',
        'cache_expire',
        'sid_length',
        'sid_bits_per_character',
    ];

    private array $data = [];

    public function start(): bool
    {
        if (\session_status() === \PHP_SESSION_ACTIVE) {
            return true;
        }

        $sessionId = $_COOKIE[\session_name()] ?? null;

        if ($sessionId && !\preg_match('/^[a-zA-Z0-9-,]{22,250}$/', $sessionId)) {
            \session_id(\session_create_id());
        }

        if (!\session_start()) {
            throw new LogicException('Can\'t start the session.');
        }

        $this->data = & $_SESSION;

        return true;
    }

    public function clear(): bool
    {
        if (\session_status() !== \PHP_SESSION_ACTIVE || \headers_sent()) {
            return false;
        }
 
        $_SESSION = [];

        \setcookie(\session_name(), '', -1, '/', '', false, true);

        return true;
    }

    public function regenerateId(): bool
    {
        if (\session_status() !== \PHP_SESSION_ACTIVE || \headers_sent()) {
            return false;
        }

        return \session_regenerate_id();
    }

    public function setOptions(array $options): void
    {
        $supportedOptions = \array_flip(self::SUPPORTED_OPTIONS);

        $diff = \array_diff_key($options, $supportedOptions);

        if (! empty($diff)) {
            throw new LogicException('Unsupported session options: ' . \implode(', ', \array_keys($diff)));
        }

        foreach ($options as $name => $value) {
            \ini_set(self::OPTIONS_PREFIX . '.' . $name, $value);
        }
    }

    public function save(): bool
    {
        if (\session_status() !== \PHP_SESSION_ACTIVE || \headers_sent()) {
            return false;
        }
        
        return \session_commit();
    }
}
