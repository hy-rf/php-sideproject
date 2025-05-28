<?php

namespace Controller\Reply;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController
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
                return $this->getReply();
            case 'POST':
                return $this->createReply();
            case 'PUT':
                return $this->updateReply();
            case 'DELETE':
                return $this->deleteReply();
            default:
                return new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    private function getReply(): Response
    {
        $data = [
            'message' => 'GET reply successful',
            'timestamp' => time(),
        ];

        return new Response(json_encode($data), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function createReply(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data['content'])) {
            return new Response(
                json_encode(['error' => 'Invalid input. Content is required.']),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $responseData = [
            'message' => 'POST reply successful',
            'content' => $data['content'],
        ];

        return new Response(json_encode($responseData), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    private function updateReply(): Response
    {
        $data = json_decode($this->request->getContent(), true);

        if (!$data || !isset($data['id']) || !isset($data['content'])) {
            return new Response(
                json_encode(['error' => 'Invalid input. ID and Content are required.']),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $responseData = [
            'message' => 'PUT reply successful',
            'updatedId' => $data['id'],
            'updatedContent' => $data['content'],
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function deleteReply(): Response
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
            'message' => 'DELETE reply successful',
            'deletedId' => $data['id'],
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}