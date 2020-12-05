<?php


class Response
{
    /**
     * Sets the server page status code, default success is 200
     * Used on errors, to return a 404 status code
     *
     * @param $code
     */
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    /**
     * Redirect user browser to a different webpage
     * E.g. when server error occurs, redirects to /error
     *
     * @param $url
     */
    public function redirect($url)
    {
        header('Location: '.$url);
    }
}
