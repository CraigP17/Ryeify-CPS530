<?php


class Request
{
    /**
     * Find the url path /_____ and returns its value.
     * Does not return query parameters such as ?code=123
     * Uses '/' when no path entered for return path to home page /
     *
     * @return false|mixed|string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // Returns only the path, and not any query parameters in the url
        $position = strpos($path, '?');
        if ($position === false)
        {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * Returns the http method type, of GET or POST
     * HELPER function to clean code instead of always calling strtolower() on the $_SERVER
     *
     * @return string
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Returns parameters sent to the endpoint, whether its to a get request, for ?code=1234 or post hidden parameters
     * Sanitizes any parameters send to it
     *
     * @return array
     */
    public function getBody(): array
    {
        // This sanitizes the data
        $body = [];
        if ($this->method() === 'get')
        {
            foreach ($_GET as $key => $value)
            {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post')
        {
            foreach ($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
