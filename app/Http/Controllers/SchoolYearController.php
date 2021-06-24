<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function index()
    {
        $sys = SchoolYear::get();
        return view('school-years.index', compact('sys'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year_start' => 'required',
            'year_end' => 'required',
            'status' => '',
            'enrolment_start_date' => '',
            'enrolment_end_date' => '',
            'enrolment_modify_date_limit' => ''
        ]);

        $sy = new SchoolYear;
        $sy->fill($data);

        if ($sy->status) {
            $sys = SchoolYear::get();

            foreach ($sys as $i => $s) {
                $s->status = 0;
                $s->save();
            }
        }

        $sy->save();

        return redirect()->back()->with('success', 'Successfully Added');
    }


    public function show(SchoolYear $schoolYear)
    {
        //
    }

    public function edit(SchoolYear $schoolYear)
    {
        return view('school-years._edit', compact('schoolYear'));
    }

    public function update(Request $request, SchoolYear $schoolYear)
    {
        $schoolYear->fill($request->all());

        if ($schoolYear->status) {
            $sys = SchoolYear::get();

            foreach ($sys as $i => $s) {
                $s->status = 0;
                $s->save();
            }
        }

        $schoolYear->save();

        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();

        return redirect('/school-years')->with('success', 'Successfully deleted!');
    }
}
