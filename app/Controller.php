<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 15:58
 */

namespace App;


abstract class Controller
{

    /**
     * Array of request params
     * @var array
     */
    protected $request = [];

    /**
     * Controller constructor.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }


    /**
     * Call public controller method
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $method = explode('-', $name);

        array_walk($method, function (&$el){
            $el = ucfirst(strtolower($el));
        });

        $method = 'action' . implode('', $method);

        if(method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }  else {
            throw new \Exception(sprintf("Method %s not found in controller %s.", $method, static::class));
        }
    }

    /**
     * Render view an return View object
     *
     * @param $template
     * @return View
     */
    public function view($template, $data = []) {
        $view = new View($template);
        $view->render($data);

        return $view;
    }
}