<?php
namespace App;

use AltoRouter;

class Router {

    /**
     * @var string
     */

    private $viewPath;

    /**
     * @var AltoRouter
     */

    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null)
    {
        $this->router->map('GET', $url, function() use($view) {
            ob_start();
            require $this->viewPath . DIRECTORY_SEPARATOR . $view;
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
        }, $name);

        return $this;
    }

    public function run(): self
    {
        $match = $this->router->match();
        if ($match && is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . '404 Not Found');
            echo ' 404 Not Found';
        }
        return $this;
    }
}