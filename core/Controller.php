<?php


namespace app\core;

use Application;

class Controller
{
    // Parent Controller class that all controllers in /controllers extend
    // Used to set layouts and render views to the user

    public $layout = 'main';    // Default layout template is main for /views/templates/main.php


    /**
     * Sets the layout view to extend
     *
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Renders the specific view by taking $view and executing the $params variables passed to the view
     * Uses Router renderView method to do so, all controller functions use render() to execute a view
     *
     * @param $view
     * @param array $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}
