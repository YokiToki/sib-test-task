<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 12:23
 */

namespace App;


class Router
{
    /**
     * Array of routes
     * @var array
     */
    protected $routes = [];

    /**
     * Controller class and method
     * @var array
     */
    protected $params = [
        \App\Controllers\NotFoundController::class,
        'index'
    ];

    /**
     * Array of request params
     * @var array
     */
    protected $request = [];


    /**
     * Add new route
     *
     * @param string $route
     * @param array $params
     */
    public function add(string $route, array $params)
    {
        // Add slashes
        $route = preg_replace('/\//', '\\/', $route);
        // Request variables
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[\w\d\+-]+)', $route);
        // Create uri pattern
        $route = sprintf('/^%s$/i', $route);

        $this->routes[$route] = $params;
    }

    /**
     * Check if matching route exist
     *
     * @param string $query
     * @return bool
     */
    public function check(string $query)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $query, $request)) {
                $request = array_filter($request, function ($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);

                $this->params = $params;
                $this->request = $request;

                return true;
            }
        }

        return false;
    }


    /**
     *
     */
    public function run()
    {
        $query = $_SERVER['REQUEST_URI'];

        try {
            $this->check($query);

            list($controller, $method) = $this->params;

            if (class_exists($controller)) {

                $obj = new $controller($this->request);
                $response = $obj->$method();

                if ($response instanceof View) {
                    $response->output();
                } else {
                    echo $response;
                }

            } else {
                throw new \Exception(sprintf("Class %s not found.", $controller));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}