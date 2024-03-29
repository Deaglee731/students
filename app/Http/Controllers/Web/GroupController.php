<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupFilterRequest;
use App\Http\Requests\GroupRequest;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(GroupFilterRequest $request)
    {
        $groups = Group::filter($request)->paginate(10);

        return view('groups.index', [
            'groups' => $groups,
            'request' => $request->validated(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupRequest $request)
    {
        Group::create($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Group $group)
    {
        return view('groups.show', [
            'group' => $group,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Group $group)
    {
        return view('groups.edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $groups
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return back();
    }

    public function showJournal(Group $group, JournalServices $journal)
    {
        $allStudents = Student::all()->where('group_id', $group->id);
        $subjects = Subject::all();

        $goodStudents = $journal->getGoodStudents($allStudents);
        $bestStudents = $journal->getBestStudents($allStudents);
        $students_subjects = $journal->getScoresWithSubjects($subjects, $allStudents);
        $avgScore = $journal->getAverageScoreWithSubjects($students_subjects);

        return view('journal.index', [
            'students_subjects' => $students_subjects,
            'subjects' => $subjects,
            'goodStudents' => $goodStudents,
            'bestStudents' => $bestStudents,
            'avgScore' => $avgScore,
        ]);
    }
}
