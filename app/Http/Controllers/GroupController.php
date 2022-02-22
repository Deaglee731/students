<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Groups;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups  = Groups::all();
        return view('groups.index',['groups' => $groups]);
        // List group get
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
        // stranica sozdanie get
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        Groups::create($request->validated());
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Groups $group)
    {
        return view ('groups.show',['group' => $group]);
        // Otobrajenie konkretnogo objecta get
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Groups $group)
    {
        return view ('groups.edit',['group' => $group]);
        // Redactirovanie conkretnogo objecta get
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Groups $group)
    {
    
        $group->update($request->validated());

        return redirect(route('groups.index'));
        //  Ovnovlenie konkretnogo objecta post
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groups $group)
    {
        $group->delete();
        
        return back();
        // udalenie konkretnogo objecta post
    }
}
