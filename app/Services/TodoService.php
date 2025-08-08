<?php
namespace App\Services;

use App\Repositories\Eloquent\TodoRepository\TodoRepository;
use App\Models\Todo;
/**
 * Class TodoService
 * Handles business logic for Todo operations.
 */
class TodoService
{
    protected $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTodos()
    {
        return $this->repository->all();
    }

    public function getTodo($id)
    {
        return $this->repository->find($id);
    }

    public function createTodo(array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->repository->create($data);
    }

    public function updateTodo(Todo $todo, array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->repository->update($todo, $data);
    }

    public function deleteTodo(Todo $todo)
    {
        return $this->repository->delete($todo);
    }
    public function getTodosByGroup($groupId)
    {
        return $this->repository->getByGroupId($groupId);
    }
}