<?php

namespace App\Http\Controllers;

use App\Models\{Subject, GradeLevel};
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index()
    {
        $subs = Subject::with('gradeLevel')->get();
        $gls = GradeLevel::get();
        return view('subjects.index',compact('gls','subs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade_level_id' => 'required',
            'status' => ''
        ]);

        $sub = new Subject;
        $sub->fill($data);
        $sub->save();

        return redirect()->back()->with('success','Successfully added!');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        $gls = GradeLevel::get();
        return view('subjects._edit',compact('subject','gls'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->fill($request->all());
        $subject->save();

        return redirect()->back()->with('success','Successfully updated!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect('/school-years')->with('success','Successfully deleted!');
    }
}
