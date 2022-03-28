<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupFilterRequest;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\SubjectResource;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Services\JournalServices;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupFilterRequest $request)
    {
        $groups = Group::filter($request)->paginate(10);

        return GroupResource::collection($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        Group::create($request->validated());

        return response()->json([
            'message' => 'Группа создана успешно',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);

    }

}
