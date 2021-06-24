<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
{
    public function index()
    {
        $gls = GradeLevel::get();
        return view('grade-levels.index',compact('gls'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required|unique:grade_levels',
        ]);

        $gl = new GradeLevel;
        $gl->name = $request->name;
        $gl->status = $request->status;
        $gl->fee = $request->fee;
        $gl->save();

        return redirect()->back()->with('success','Successfully added!');
    }

    public function show(GradeLevel $gradeLevel)
    {
        //
    }

    public function edit(GradeLevel $gradeLevel)
    {
        return view('grade-levels._edit',compact('gradeLevel'));
    }

    public function update(Request $request, GradeLevel $gradeLevel)
    {
        $gradeLevel->name = $request->name;
        $gradeLevel->status = $request->status;
        $gl->fee = $request->fee;
        $gradeLevel->save();

        return redirect()->back()->with('success','Successfully updated!');
    }

    public function destroy(GradeLevel $gradeLevel)
    {
        $gradeLevel->delete();

        return redirect('/grade-levels')->with('success','Successfully deleted!');
    }
}