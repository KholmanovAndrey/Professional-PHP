<?php

namespace App\services;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }
        return array_key_exists($key, $_SESSION)
            ? $_SESSION[$key]
            : [];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}