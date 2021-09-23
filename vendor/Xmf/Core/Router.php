<?php

namespace Xmf\Core;

use Xmf\Exceptions\RouterException;

class Router
{
    public string $default_controller = "MainController";
    public string $default_action = "index";

    public function getParts($url): array
    {
        $parts = explode("/", preg_replace('/\/+/', '/', trim($url, '/')));

        return strlen($parts[0]) > 0 ? $parts : [];
    }

    /**
     * @throws RouterException
     */
    public function __construct()
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];
        $url_parts = $this->getParts($request_uri);


        if (!isset($url_parts[0])) {
            if (!isset($this->default_controller))
                throw new RouterException("There is no `default_controller` configured!");

            $url_parts[0] = $this->default_controller;
        }

        if (!stristr($url_parts[0], 'controller')) {
            $url_parts[0] = Utils::convertToCamelCase($url_parts[0]) . 'Controller';
        }

        if (!isset($url_parts[1])) {
            if (!isset($this->default_action))
                throw new RouterException("There is no `default_action` configured!");

            $url_parts[1] = $this->default_action;
        }

        $url_parts[1] = Utils::convertToPascalCase(strtolower($request_method) . $url_parts[1]);

        return $this->call($url_parts[0], $url_parts[1], ...array_slice($url_parts, 2)) || $this->notFound();
    }

    public function call($controller, $action, ...$params): bool
    {
        if (!class_exists($controller) || !method_exists($controller, $action)) {
            return false;
        }

        return !call_user_func([new $controller, $action], $params);
    }

    public function notFound(): bool
    {
        http_response_code(404);
        echo "Page not found.";
        return true;
    }
}