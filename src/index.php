<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

if ($request->getMethod() === 'GET') {
    $response = new Response('Hello', Response::HTTP_OK);
} else {
    $response = new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
}

$response->send();