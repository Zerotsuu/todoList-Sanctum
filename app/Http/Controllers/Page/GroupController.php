<?php

namespace App\Http\Controllers\Page;

use App\Models\TodoGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoGroups\StoretodoGroupRequest;
use App\Http\Requests\TodoGroups\UpdatetodoGroupRequest;
use Inertia\Inertia;
use Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('todoGroup/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('todoGroup/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretodoGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoGroup $todoGroup)
    {
        
        return Inertia::render('todoGroup/Show', ['id' => (string) $todoGroup->id]);
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
    public function update(UpdateTodoGroupRequest $request, todoGroup $todoGroup)
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
