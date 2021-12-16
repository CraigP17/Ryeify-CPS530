<?php 

/**
 * Class Router
 */
class Router
{
    public $request;
    public $response;
    protected $routes = [];

    /**
     * Router constructor
     * request is the url endpoint /about
     * response is the assigned controller and corresponding function within controller for specific path
     *          function response to that url
     *
     * @param $request
     * @param $response
     */
    function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * GET
     * Assigns controller to url path
     * e.g. called as such: router->get('/about', [SiteController::class, 'about']
     *      where SiteController contains a function called about()
     *
     * @param $path      // url path
     * @param $callback  // callback Controller class and function name to assign to the path
     */
    public function get($path, $callback)
    {
        // Will need a check here
        $this->routes['get'][$path] = $callback;
    }

    /**
     * POST
     * Assigns controller to url path
     * e.g. called as such: router->get('/login', [AuthController::class, 'login']
     *      where AuthController contains a function called login()
     *
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        // Will need a check here
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)
        {
            Application::$app->response->setStatusCode(404);
            return $this->renderView("error404");
        }

        if (is_string($callback))
        {
            return $this->renderView($callback);
        }

        if (is_array($callback))
        {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;

        }
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * Returns the completed view php/html code with a $params array to replace the $params used in the view
     *
     * @param $view
     * @param array $params
     * @return string|string[]
     */
    public function renderView($view, array $params = [])
    {
        $layoutContent = $this->layoutContent();                // Sets which layout file to use (default is main.php)
        $viewContent = $this->renderOnlyView($view, $params);   // Evaluates $params in the $view php file

        // Replaces the {{content}} string within the template file (/views/templates/main.php) with the view file
        // So essentially the $view file is inserted into the main.php file to extended its layout, and therefore
        //      have a consistent heading nav and footer
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Replaces the {{content}} in layout main.php file with the associated view
     * Inserts view into template file for consistent overall layout
     *
     * Different from renderView() because the $view does not have an $params variables to evaluate
     *
     * @param $viewContent
     * @return false|string|string[]
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Returns the layout view template file (/views/templates/main.php)
     *
     * @return false|string
     */
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once "../views/templates/$layout.php";
        return ob_get_clean();
    }

    /**
     * Renders the view file (/views/*.php) by replacing any $params variables with their actual values
     *
     * @param $view
     * @param $params
     * @return false|string
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;     // Will be evaluated as key variable outside of params
        }
        ob_start();
        include_once "../views/$view.php";
        return ob_get_clean();
    }
}
