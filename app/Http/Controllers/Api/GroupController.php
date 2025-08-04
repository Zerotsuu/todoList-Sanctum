<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todos\StoreTodoGroupRequest;
use App\Http\Requests\Todos\UpdateTodoGroupRequest;
use Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = TodoGroup::all();
        Log::info('Fetching all todos');
        return response()->json($todos);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoGroup $todoGroup)
    {
        Log::info('Fetching todo with ID: ' . $todoGroup->id);
        return response()->json($todoGroup);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoGroup $todoGroup)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoGroupRequest $request, TodoGroup $todoGroup)
    {
        $todoGroup->update($request->validated());
        Log::info('Updated todo with ID: ' . $todoGroup->id);
        return response()->json($todoGroup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoGroup $todoGroup)
    {
        $todoGroup->delete();
        Log::info('Deleted todo with ID: ' . $todoGroup->id);
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
