<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $model;
    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @param User $model
     * @param Builder $builder
     */
    public function __construct(
        User $model,
        Builder $builder
    ) {
        $this->model = $model;
        $this->builder = $builder;
    }

    /**
     * @return User
     */
    public function getModel(): User
    {
        return $this->model;
    }

    /**
     * @return Builder|\LaravelIdea\Helper\App\Models\_IH_User_QB|mixed
     */
    public function getBuilder()
    {
        return $this->builder = $this->getModel()::query();
    }

    /**
     * @param Builder $builder
     * @return $this|mixed
     */
    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @param array $columns
     * @return User[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->getBuilder()->get($columns);
    }

    /**
     * @param int $id
     * @return User
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): User
    {
        return $this->getBuilder()->findOrfail($id);
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return $this->getBuilder()->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @param array $options
     * @return User
     */
    public function update(array $attributes, int $id, array $options = []): User
    {
        $model = $this->findOrFail($id);

        $model->update($attributes, $options);

        return $model;
    }

    /**
     * @param int $id
     * @return User
     *
     * @throws ModelNotFoundException
     */
    public function destroy(int $id): User
    {
        $model = $this->findOrFail($id);

        $model->delete();

        return $model;
    }
}
