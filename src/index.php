<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Controller\Post\PostController;
use Controller\Reply\ReplyController;

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

switch ($path) {
    case "/post":
        $controller = new PostController($request);
        break;
    case "/reply":
        $controller = new ReplyController($request);
        break;
    default:
        $response = new Response("Not Found", Response::HTTP_NOT_FOUND);
        $response->send();
        exit();
}

$response = $controller->handle();
$response->send();
