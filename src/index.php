<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Controller\Auth\AuthController;
use Controller\Grade\GradeController;
use Controller\Subject\SubjectController;
use Controller\Class\ClassController;
use Controller\Student\StudentController;

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

switch ($path) {
    case "/auth":
        $controller = new AuthController($request);
        break;
    case "/grade":
        $controller = new GradeController($request);
        break;
    case "/subject":
        $controller = new SubjectController($request);
        break;
    case "/class":
        $controller = new ClassController($request);
        break;
    case "/student":
        $controller = new StudentController($request);
        break;
    default:
        $response = new Response("Not Found", Response::HTTP_NOT_FOUND);
        $response->send();
        exit();
}

$response = $controller->handle();
$response->send();
