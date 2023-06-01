<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Query\Builder;

interface UserRepositoryInterface
{
    /**
     * @return User
     */
    public function getModel(): User;

    /**
     * @return mixed
     */
    public function getBuilder();

    /**
     * @param Builder $builder
     * @return mixed
     */
    public function setBuilder(Builder $builder);

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * @param int $id
     * @return User
     */
    public function findOrFail(int $id): User;

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User;

    /**
     * @param array $attributes
     * @param int $id
     * @param array $options
     * @return User
     */
    public function update(array $attributes, int $id, array $options = []): User;

    /**
     * @param int $id
     * @return User
     */
    public function destroy(int $id): User;
}
