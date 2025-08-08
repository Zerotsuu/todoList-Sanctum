<?php
namespace App\Services;

use App\Repositories\Eloquent\TodoGroupRepository\TodoGroupRepository;
use App\Models\TodoGroup;
/**
 * Class TodoService
 * Handles business logic for Todo operations.
 */
class TodoGroupService
{
    protected $repository;

    public function __construct(TodoGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTodoGroups()
    {
        return $this->repository->all();
    }

    public function getTodoGroup($id)
    {
        return $this->repository->find($id);
    }

    public function createTodoGroup(array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->repository->create($data);
    }

    public function updateTodoGroup(TodoGroup $todoGroup, array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->repository->update($todoGroup, $data);
    }

    public function deleteTodoGroup(TodoGroup $todoGroup)
    {
        return $this->repository->delete($todoGroup);
    }
}