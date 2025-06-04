<?php

namespace Service\Auth;

use Data\Data;

class AuthController
{
    private Data $dataHandler;

    public function __construct()
    {
        $this->dataHandler = new Data();
    }

    public function createUser(): bool
    {
        $userData = ['name' => 'John Doe', 'email' => 'john.doe@example.com'];
        return $this->dataHandler->save($userData);
    }
}
