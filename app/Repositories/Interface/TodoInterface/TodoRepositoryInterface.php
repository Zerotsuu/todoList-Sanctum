<?php

namespace App\Repositories\Interface\TodoInterface;

use App\Models\Todo;
interface TodoRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(Todo $todo, array $data);
    public function delete(Todo $todo);
}