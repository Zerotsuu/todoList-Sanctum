<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todos\StoreTodoRequest;
use App\Http\Requests\Todos\UpdateTodoRequest;
use Inertia\Inertia;
use Log;
use App\Services\TodoService;

class TodoController extends Controller
{
    protected $service;

    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = $this->service->getAllTodos();
        Log::info('Fetching all todos');
        return response()->json($todos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return Inertia::render('todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $this->authorize('create', Todo::class);
        $todo = $this->service->createTodo($request->validated());
        Log::info('Created new todo with ID: ' . $todo->id);
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $todo = $this->service->getTodo($id);
        $this->authorize('view', $todo);
        Log::info('Fetching todo with ID: ' . $todo->id);
        return response()->json($todo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $id = $todo->id;
        return Inertia::render('todo/Update', ['id' => (string) $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $updated = $this->service->updateTodo($todo, $request->validated());
        Log::info('Updated todo with ID: ' . $todo->id);
        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $this->service->deleteTodo($todo);
        Log::info('Deleted todo with ID: ' . $todo->id);
        return response()->json(['message' => 'Todo deleted successfully']);
    }

    /**
     * Get todos by group ID.
     */
    public function getByGroup($groupId)
    {
        $todos = $this->service->getTodosByGroup($groupId);
        Log::info('Fetching todos for group ID: ' . $groupId);
        return response()->json($todos);
    }
}
