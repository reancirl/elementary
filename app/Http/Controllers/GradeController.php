<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\StudentGrade;
use App\Models\Enrolment;
use App\Models\EnrolmentSubjects;

class GradeController extends Controller
{
    public function index()
    {
        $sections = Section::where('status',1);
        
        if(auth()->user()->hasRole('teacher')) {
            $sections = $sections->where('adviser_id',auth()->user()->id);
        }

        $sections = $sections->get();

        return view('grades.index',compact('sections'));
    }

    public function create(Request $request,$section_id,$subject_id)
    {
        $section = Section::findOrFail($section_id);
        $subject = Subject::findOrFail($subject_id);
        $data = Grade::where('type',$request->type)->where('section_id',$section_id)->where('subject_id',$subject_id)->get();
        return view('grades.type',compact('section','subject','request','data'));
    }

    public function store(Request $request)
    {
        $grade = new Grade;
        $grade->fill($request->all());
        $grade->save();

        return redirect()->back()->with('success','Successfully Added');
    }

    public function show($id)
    {
        $section = Section::with('gradeLevel.subjects')->findOrFail($id);
        return view('grades.subjects',compact('section'));
    }

    public function edit($id)
    {
        $data = Grade::with('subject')->findOrFail($id);
        $section = Section::findOrFail($data->section_id);
        $enrolments = Enrolment::with('student.user')->where('section_id',$section->id)->get();

        return view('grades.edit',compact('data','section','enrolments'));
    }

    public function update(Request $request, $id)
    {
        foreach($request->score as $i => $score) {
            $exist = StudentGrade::where('enrolment_subject_id',$request->enrolment_subject_id[$i])->where('grade_id',$request->grade_id[$i])->first();

            if(!$exist) {
                $data = new StudentGrade;
                $data->enrolment_subject_id = $request->enrolment_subject_id[$i];
                $data->grade_id = $request->grade_id[$i];
                $data->score = $request->score[$i];
                $data->percentage = $request->percentage[$i];
                $data->save();
            } else {
                $exist->score = $request->score[$i];
                $exist->percentage = $request->percentage[$i];
                $exist->save();
            }
        }

        return redirect()->back()->with('success','Successfully Recorded');
    }

    public function overallGrade($section_id,$subject_id) {
        $section = Section::findOrFail($section_id);
        $subject = Subject::findOrFail($subject_id);

        $enrolments = Enrolment::with('student.user')
                                ->join('enrolment_subjects as es','es.enrolment_id','enrolments.id')
                                ->where('enrolments.section_id',$section_id)
                                ->where('es.subject_id',$subject_id)
                                ->select('enrolments.id as enrolment_id','section_id','es.id as enrolment_subject_id','subject_id','student_id','es.first_grading_grade','es.second_grading_grade','es.third_grading_grade','es.fourth_grading_grade')
                                ->get();

        return view('grades.overall',compact('section','subject','enrolments'));
    }

    public function overallGradeStore(Request $request) {

        foreach($request->enrolment_id as $i => $enrolment_id) {
            $exist = EnrolmentSubjects::where('enrolment_id',$enrolment_id)->where('subject_id',$request->subject_id)->first();
            if(!$exist) {
                $data = new EnrolmentSubjects;
                $data->enrolment_id = $enrolment_id;
                $data->subject_id = $request->subject_id;
                $data->first_grading_grade = $request->first_grading_grade[$i] ?? null;
                $data->second_grading_grade = $request->second_grading_grade[$i] ?? null;
                $data->third_grading_grade = $request->third_grading_grade[$i] ?? null;
                $data->fourth_grading_grade = $request->fourth_grading_grade[$i] ?? null;
                $data->save();
            } else {
                $exist->first_grading_grade = $request->first_grading_grade[$i] ?? null;
                $exist->second_grading_grade = $request->second_grading_grade[$i] ?? null;
                $exist->third_grading_grade = $request->third_grading_grade[$i] ?? null;
                $exist->fourth_grading_grade = $request->fourth_grading_grade[$i] ?? null;
                $exist->save();
            }
        }

        return redirect()->back()->with('success','Successfully Recorded');
    }

    public function destroy($id)
    {
        //
    }
}
