<?php

namespace App\Http\Controllers\Page;

use App\Models\TodoGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Inertia\Inertia;
use Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('togoGroup/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        
        return Inertia::render('todo/Show', ['id' => (string) $todo->id]);
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
        $todo->update($request->validated());
        Log::info('Updated todo with ID: ' . $todo->id);
        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        Log::info('Deleted todo with ID: ' . $todo->id);
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
