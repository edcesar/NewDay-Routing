<?php
namespace NewDay\Routing;

class Router implements RouterInterface
{
    private $config = [];
    private $uri;

    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $this->setUri($uri);
        }

    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setRouteAndCallback($route, $callback)
    {
        $this->config[] = [$route => $callback];
    }

    public function getRoute()
    {
        return '/contact';
    }

    public function route($route, $callback)
    {
        $this->setRouteAndCallback($route, $callback);
    }

    public function run()
    {
        $route = $this->getConfigs($this->getUri());

        if ($route) {
            if (is_callable($route[$this->getUri()])) {
                return call_user_func($route[$this->getUri()], []);
            } else {
                $config = explode(':', $route[$this->getUri()]);

                $class = $config[0];
                $method = $config[1];

                return call_user_func_array([new $class, $method], []);
            }
        }

        http_response_code(404);

    }

    public function getConfigs($route = null)
    {
        if (is_null($route)) {
            return $this->config;
        } else {
            foreach ($this->config as $routeConfig) {
                if (array_key_exists($route, $routeConfig)) {
                    return $routeConfig;
                }
            }
        }
    }
}
