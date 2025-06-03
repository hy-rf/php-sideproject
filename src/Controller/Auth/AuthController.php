<?php

namespace Controller\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): Response
    {
        switch ($this->request->getMethod()) {
            case "GET":
                return $this->get();
            case "POST":
                return $this->post();
            case "PUT":
                return $this->put();
            case "DELETE":
                return $this->delete();
            default:
                return new Response(
                    "Method Not Allowed",
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
        }
    }

    private function get(): Response
    {
        $data = [
            "message" => "GET successful",
            "timestamp" => time(),
        ];

        return new Response(json_encode($data), Response::HTTP_OK, [
            "Content-Type" => "application/json",
        ]);
    }

    private function post(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data["content"])) {
            return new Response(
                json_encode(["error" => "Invalid input. Content is required."]),
                Response::HTTP_BAD_REQUEST,
                ["Content-Type" => "application/json"]
            );
        }

        $responseData = [
            "message" => "POST reply successful",
            "content" => $data["content"],
        ];

        return new Response(
            json_encode($responseData),
            Response::HTTP_CREATED,
            ["Content-Type" => "application/json"]
        );
    }

    private function put(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!isset($data["id"])) {
            return new Response(
                json_encode(["error" => "Id is empty"]),
                Response::HTTP_BAD_REQUEST,
                ["Content-Type" => "application/json"]
            );
        }
        if (!$data || !isset($data["content"])) {
            return new Response(
                json_encode(["error" => "Invalid input. Content is required."]),
                Response::HTTP_BAD_REQUEST,
                ["Content-Type" => "application/json"]
            );
        }

        $responseData = [
            "message" => "POST reply successful",
            "content" => $data["content"],
        ];

        return new Response(
            json_encode($responseData),
            Response::HTTP_CREATED,
            ["Content-Type" => "application/json"]
        );
    }

    private function delete(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!isset($data["id"])) {
            return new Response(
                json_encode(["error" => "Id is empty"]),
                Response::HTTP_BAD_REQUEST,
                ["Content-Type" => "application/json"]
            );
        }
        if (!$data || !isset($data["content"])) {
            return new Response(
                json_encode(["error" => "Invalid input. Content is required."]),
                Response::HTTP_BAD_REQUEST,
                ["Content-Type" => "application/json"]
            );
        }

        $responseData = [
            "message" => "POST reply successful",
            "content" => $data["content"],
        ];

        return new Response(
            json_encode($responseData),
            Response::HTTP_CREATED,
            ["Content-Type" => "application/json"]
        );
    }
}
