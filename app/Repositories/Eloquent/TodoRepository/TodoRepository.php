<?php

namespace App\Repositories\Eloquent\TodoRepository;

use App\Models\Todo;
use App\Repositories\Interface\TodoInterface\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    
    /**
     * Get all todos.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Todo::all();
    }

    /**
     * Find a todo by its ID.
     *
     * @param int $id
     * @return Todo
     */
    public function find($id)
    {
        return Todo::findOrFail($id);
    }

    /**
     * Create a new todo.
     *
     * @param array $data
     * @return Todo
     */
    public function create(array $data)
    {
        return Todo::create($data);
    }

    /**
     * Update an existing todo.
     *
     * @param Todo $todo
     * @param array $data
     * @return Todo
     */
    public function update(Todo $todo, array $data)
    {
        $todo->update($data);
        return $todo;
    }

    /**
     * Delete a todo.
     *
     * @param Todo $todo
     * @return bool|null
     */
    public function delete(Todo $todo)
    {
        return $todo->delete();
    }
}