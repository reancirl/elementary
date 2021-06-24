<?php

namespace App\Http\Controllers;

use App\Models\{Section, GradeLevel, User};
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $gls = GradeLevel::get();
        $advisers = User::role('teacher')->get();
        $secs = Section::with('gradeLevel.subjects')->get();
        return view('sections.index', compact('gls', 'secs', 'advisers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'grade_level_id' => 'required',
            'adviser_id' => '',
            'status' => ''
        ]);

        $sec = new Section;
        $sec->fill($data);
        $sec->save();

        if ($sec->gradeLevel->subjects->count() == 0) {
            $sec->status = 0;
            $sec->save();
        }

        return redirect()->back()->with('success', 'Successfully added!');
    }

    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        $gls = GradeLevel::get();
        $advisers = User::role('teacher')->get();
        return view('sections._edit', compact('section', 'gls', 'advisers'));
    }

    public function update(Request $request, Section $section)
    {
        $section->fill($request->all());
        $section->save();

        if ($section->gradeLevel->subjects->count() == 0) {
            $section->status = 0;
            $section->save();
        }

        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect('/sections')->with('success', 'Successfully deleted!');
    }
}
