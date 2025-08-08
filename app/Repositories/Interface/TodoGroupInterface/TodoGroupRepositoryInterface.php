<?php

namespace App\Repositories\Interface\TodoGroupInterface;

use App\Models\TodoGroup;
interface TodoGroupRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(TodoGroup $todo, array $data);
    public function delete(TodoGroup $todo);
}