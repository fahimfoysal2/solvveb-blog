<?php


namespace App\Repository\Repositories;


use App\Repository\Interfaces\IEloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

abstract class BaseRepository implements IEloquentRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }


    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes): Model
    {
        return $this->model->where(['id' => $id])->update($attributes);
    }

    /**
     * Update with fill
     * @param $id
     * @param array $attributes
     * @return Model | bool
     */
    public function fill($id, array $attributes): bool
    {
        return $this->model->find($id)->fill($attributes)->save();
    }

    /**
     * Delete
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->model->destroy($id);
    }


    public function where(...$where): Builder
    {
        return $this->model->where(...$where);
    }

    public function with(...$with): Builder
    {
        return $this->model->with(...$with);
    }

    public function get(): Collection
    {
        return $this->model->get();
    }

    /**
     * Get All data in Latest Order
     * @return mixed
     */
    public function getAllLatest()
    {
        return $this->model->latest()->get();
    }

    /**
     * Get All data in Latest Order With another Model
     * @return mixed
     */
    public function getAllLatestWith($model)
    {
        return $this->model->latest()->with($model)->get();
    }
}
