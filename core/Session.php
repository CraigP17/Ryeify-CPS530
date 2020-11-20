<?php


namespace app\core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];      // Get all flash messages
        foreach ($flashMessages as $key => &$flashMessage)
        {
            // Mark to be removed, so removed when request is completed
            $flashMessage['remove'] = true;
        }
        // Set the modified messages back into the session
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];      // Get all flash messages
        foreach ($flashMessages as $key => &$flashMessage)
        {
            if ($flashMessage['remove'])
            {
                unset($flashMessages[$key]);        // Removed only ones to remove
            }
        }
        // Set the modified messages back into the session
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
