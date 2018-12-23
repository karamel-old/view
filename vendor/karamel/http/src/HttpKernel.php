<?php

namespace Karamel\Http;
class HttpKernel
{
    protected static $instance;
    protected $routeMiddlewares;
    protected $kernelClass;

    public static function getInstance()
    {
        if (self::$instance == null) {
            $class = get_called_class();
            self::$instance = new $class();
        } else {
            $classType = (new \ReflectionClass(self::$instance))->getName();
            if ($classType != get_called_class()) {
                $class = get_called_class();
                self::$instance = new $class();
            }
        }
        return self::$instance;
    }

    public function checkRouteMiddlewareExists($name)
    {
        return isset($this->routeMiddlewares[$name]);
    }

    public function getRouteMiddleware($name, $default = null)
    {
        return isset($this->routeMiddlewares[$name]) ? $this->routeMiddlewares[$name] : $default;
    }

    public function getKernelClass()
    {
        return $this->kernelClass;
    }

    public function setKernelClass($class)
    {
        $this->kernelClass = $class;
    }
}