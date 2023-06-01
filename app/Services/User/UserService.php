<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        return $this->userRepository->findOrFail($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return User
     */
    public function updateUser(array $data, int $id): User
    {
        return $this->userRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @return User
     */
    public function destroyUser(int $id): User
    {
        return $this->userRepository->destroy($id);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data): bool
    {
        return Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
    }

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
