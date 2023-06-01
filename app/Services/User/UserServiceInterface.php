<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User;

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User;

    /**
     * @param array $data
     * @param int $id
     * @return User
     */
    public function updateUser(array $data, int $id): User;

    /**
     * @param int $id
     * @return User
     */
    public function destroyUser(int $id): User;

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data): bool;

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User;
}
