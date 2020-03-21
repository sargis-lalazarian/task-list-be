<?php

class Router
{
    static public function parse($url, $request)
    {
        $url = trim($url);

        $explodeUrl = explode('/', $url);
        $explodeUrl = array_slice($explodeUrl, 2);

        if (!($explodeUrl[0] ?? false)) {
            $explodeUrl[0] = 'tasks'; # default controller
        }

        if (!($explodeUrl[1] ?? false)) {
            $explodeUrl[1] = 'index'; # default action
        }

        $request->controller = $explodeUrl[0];
        $actionUrl = explode('?', $explodeUrl[1]);
        $request->action = $actionUrl[0];
        $request->params = array_slice($explodeUrl, 2);
    }
}
