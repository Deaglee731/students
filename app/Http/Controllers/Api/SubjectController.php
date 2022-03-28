<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectFilterRequest;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\StudentResource;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubjectFilterRequest $request)
    {
        $subjects = Subject::filter($request)->paginate(10);

        return SubjectResource::collection($subjects);
    }

    public function store(SubjectRequest $request)
    {
        $student = Subject::create($request->validated());

        return new StudentResource($student)
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subjects
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subjects
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return new SubjectResource($subject)
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subjects
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);

    }
}
