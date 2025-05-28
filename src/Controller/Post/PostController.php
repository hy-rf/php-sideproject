<?php

namespace Controller\Post;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): Response
    {
        switch ($this->request->getMethod()) {
            case 'GET':
                return $this->get();
            case 'POST':
                return $this->create();
            case 'PUT':
                return $this->update();
            case 'DELETE':
                return $this->delete();
            default:
                return new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    private function get(): Response
    {
        $data = [
            'message' => 'GET request to /post',
            'posts' => [
                ['id' => 1, 'title' => 'First Post'],
                ['id' => 2, 'title' => 'Second Post'],
            ],
        ];

        return new Response(json_encode($data), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function create(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data['title'])) {
            return new Response(
                json_encode(['error' => 'Invalid input. Title is required.']),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $responseData = [
            'message' => 'POST request to /post',
            'createdPost' => ['id' => rand(1, 1000), 'title' => $data['title']],
        ];

        return new Response(json_encode($responseData), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    private function update(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data['id']) || !isset($data['title'])) {
            return new Response(
                json_encode(['error' => 'Invalid input. ID and Title are required.']),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $responseData = [
            'message' => 'PUT request to /post',
            'updatedPost' => ['id' => $data['id'], 'title' => $data['title']],
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function delete(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data['id'])) {
            return new Response(
                json_encode(['error' => 'Invalid input. ID is required.']),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $responseData = [
            'message' => 'DELETE request to /post',
            'deletedPostId' => $data['id'],
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}