<?php

namespace App\Repositories\Eloquent\TodoGroupRepository;

use App\Models\TodoGroup;
use App\Repositories\Interface\TodoGroupInterface\TodoGroupRepositoryInterface;

class TodoGroupRepository implements TodoGroupRepositoryInterface
{
    
    /**
     * Get all TodoGroup.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return TodoGroup::all();
    }

    /**
     * Find a todo by its ID.
     *
     * @param int $id
     * @return TodoGroup
     */
    public function find($id)
    {
        return TodoGroup::findOrFail($id);
    }

    /**
     * Create a new TodoGroup.
     *
     * @param array $data
     * @return TodoGroup
     */
    public function create(array $data)
    {
        return TodoGroup::create($data);
    }

    /**
     * Update an existing TodoGroup.
     *
     * @param TodoGroup $todo
     * @param array $data
     * @return TodoGroup
     */
    public function update(TodoGroup $todo, array $data)
    {
        $todo->update($data);
        return $todo;
    }

    /**
     * Delete a TodoGroup.
     *
     * @param TodoGroup $todo
     * @return bool|null
     */
    public function delete(TodoGroup $todo)
    {
        return $todo->delete();
    }
}