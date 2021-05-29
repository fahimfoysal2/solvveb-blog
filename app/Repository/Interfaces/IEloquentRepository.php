<?php


namespace App\Repository\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

interface IEloquentRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;


    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes): Model;

    public function fill($id, array $attributes): bool;


    /**
     * Delete
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    public function where(...$where): Builder;

    public function with(...$with): Builder;

    public function get(): Collection;

    public function getAllLatest();
}
