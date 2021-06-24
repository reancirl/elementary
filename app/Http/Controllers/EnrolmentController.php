<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Enrolment, Section, GradeLevel, SchoolYear, Fee, EnrolmentSubjects};

class EnrolmentController extends Controller
{
    public function fillSections(Request $request)
    {
        $sections = Section::where('grade_level_id', $request->grade_level_id)
            ->where('status', 1)
            ->get();

        return response([
            'sections' => $sections,
            'count' => $sections->count()
        ]);
    }
    public function index(Request $request)
    {
        $gls = GradeLevel::where('status',1)->get();
        $enrolments = Enrolment::with('student.user','section.gradeLevel');
        $sys = SchoolYear::where('status',1)->get();

        if($request->sy_id) {
            $enrolments = $enrolments->where('school_year_id',$request->sy_id);
        }

        if($request->grade_level_id) {
            $grade_level_id = $request->grade_level_id;
            $enrolments = $enrolments->with(['section' => function ($query) use ($grade_level_id){
                $query->where('grade_level_id',$grade_level_id);
            }]);
        }

        if($request->keyword) {
            $keyword = $request->keyword;
            $enrolments = $enrolments->with(['student' => function ($query) use ($keyword){
                $query->where('id_number', 'LIKE','%'.$keyword.'%')
                      ->orWhere('last_name', 'LIKE','%'.$keyword.'%')
                      ->orWhere('first_name', 'LIKE','%'.$keyword.'%')
                      ->orWhere('middle_name', 'LIKE','%'.$keyword.'%');
            }]);
        }

        $enrolments = $enrolments->get();
        return view('enrolments.index',compact('enrolments','gls','request','sys'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $sy_id = SchoolYear::where('status', 1)->first()->id;
        $exist = Enrolment::where('student_id', $request->student_id)->where('school_year_id', $sy_id)->where('withdrawn',0)->first();

        if ($exist) {
            return redirect()->back()->with('error', 'Student already enrolled');
        }

        $enrolment = new Enrolment;
        $enrolment->student_id = $request->student_id;
        $enrolment->school_year_id = $sy_id;
        $enrolment->section_id = $request->section_id;
        $enrolment->date_enroled = now();
        $enrolment->enroled_by = auth()->user()->id;
        $enrolment->save();

        $fee = new Fee;
        $fee->enrolment_id = $enrolment->id;
        $fee->student_id = $enrolment->student_id;
        $fee->total_amount = $enrolment->section->gradeLevel->fee;
        $fee->remaining_balance = $enrolment->section->gradeLevel->fee;
        $fee->save();

        foreach ($enrolment->section->gradeLevel->subjects as $i => $subject) {
            $new_sub = new EnrolmentSubjects;
            $new_sub->enrolment_id = $enrolment->id;
            $new_sub->subject_id = $subject->id;
            $new_sub->subject_id = $subject->id;
            $new_sub->save();
        }

        return redirect()->back()->with('success', 'Student successfully enrolled');
    }

    public function show(Enrolment $enrolment)
    {
        //
    }

    public function edit($id)
    {
        $enrolment = Enrolment::with('student.user','section.gradeLevel')->findOrFail($id);
        $sections = Section::where('grade_level_id', $enrolment->section_id)
            ->where('status', 1)
            ->get();
        return view('enrolments.edit',compact('enrolment','sections'));
    }

    public function update(Request $request,$id)
    {
        $enrolment = Enrolment::findOrFail($id);
        $enrolment->section_id = $request->section_id;
        $enrolment->withdrawn = $request->status;
        $enrolment->date_enroled = now();
        $enrolment->enroled_by = auth()->user()->id;
        $enrolment->save();

        return redirect()->back()->with('success', 'Enrolment successfully updated!');
    }

    public function destroy(Enrolment $enrolment)
    {
        //
    }
}
