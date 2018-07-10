<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 15:44
 */

namespace App;

class View
{
    /**
     * Rendered content
     * @var string
     */
    protected $content;

    /**
     * nane of html template
     * @var string
     */
    protected $template = null;

    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Render view with data
     *
     * @param array $data
     * @throws \Exception
     */
    public function render(array $data)
    {
        $path = __DIR__ . '/../views/' . $this->template . '.php';

        if (is_file($path)) {
            extract($data);
            ob_start();
            include($path);

            $this->content = ob_get_contents();

            ob_end_clean();
        } else {
            throw new \Exception(sprintf('View file %s not found', $this->template));
        }
    }

    public function output()
    {
        echo $this->content;
    }
}