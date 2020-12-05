<?php


namespace app\core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Session constructor.
     * Instantiates session to store messages
     * Removes any flash messages (messages stored in session to be display on page only once)
     */
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

    /**
     * Adds a key => value to the user's session
     * HELPER to clean code
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns a value for the given key from the user's session
     * HELPER to clean code
     *
     * @param $key
     * @return false|mixed
     */
    public function get($key)
    {
        // returns if $key exists else false
        return $_SESSION[$key] ?? false;
    }

    /**
     * Removes a key from the user's session
     * HELPER to clean code
     *
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Sets a flash message in the session
     * -> flash messages are stored in session to be displayed on page only once
     *
     * @param $key
     * @param $message
     */
    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    /**
     * Sets a flash message $value in the session for the given $key, if exists
     * -> flash messages are stored in session to be displayed on page only once
     *
     * @param $key
     * @return false|mixed
     */
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * Removes flash session messages on the destruction of the user's session
     * Called when session object is deleted
     * -> flash messages are stored in session to be displayed on page only once
     */
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
