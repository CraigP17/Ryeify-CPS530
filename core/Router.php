<?php 

/**
 * Class Router
 */
class Router
{
    public $request;
    public $response;
    protected $routes = [];


    public function get($path, $callback)
    {
        // Will need a check here
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        // Will need a check here
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Router constructor.
     * @param $request
     * @param $response
     */
    function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = isset($this->routes[$method][$path]) ? $this->routes[$method][$path] : false;
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

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/templates/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;     // Will be evaluated as key variable outside of params
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
