<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoGroups\StoreTodoGroupRequest;
use App\Http\Requests\TodoGroups\UpdateTodoGroupRequest;
use Inertia\Inertia;
use Log;
use App\Services\TodoGroupService;

class TodoGroupController extends Controller
{
    protected $service;
    public function __construct(TodoGroupService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todoGroups = $this->service->getAllTodoGroups();
        Log::info('Fetching all Todo Groups');

        return response()->json($todoGroups);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoGroupRequest $request)
    {
        Log::info('Creating new Todo Group');
        $this->authorize('create', TodoGroup::class);
        $todoGroup = $this->service->createTodoGroup($request->validated());
        Log::info('Created new group with ID: '. $todoGroup->id);
        return response()->json($todoGroup);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $todoGroup = $this->service->getTodoGroup($id);
        $this->authorize('view', $todoGroup);
        Log::info('Fetching Todo Group with ID: ' . $todoGroup->id);
        return response()->json($todoGroup);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoGroup $todoGroup)
    {
        $id = $todoGroup->id;
        return Inertia::render('todoGroup/Update', ['id' => (string) $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoGroupRequest $request, TodoGroup $todoGroup)
    {
        $this->authorize('update', $todoGroup);
        $updated = $this->service->updateTodoGroup($todoGroup, $request->validated());
        Log::info('Updated Todo Group with ID: ' . $todoGroup->id);
        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoGroup $todoGroup)
    {
        $this->authorize('delete', $todoGroup);
        $this->service->deleteTodoGroup($todoGroup);
        Log::info('Deleted Todo Group with ID: ' . $todoGroup->id);
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
