<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentParent;
use App\Models\Enrolment;
use App\Models\Student;

class PortalController extends Controller
{
    public function individualGrade() {
        $user = auth()->user();

        if($user->hasRole('parent'))  {
            $student_id = StudentParent::where('mothers_maiden_name',$user->name)
                                    ->orWhere('fathers_name',$user->name)
                                    ->first()->student_id;
        } else {
            $student_id = $user->student->id;
        }
        

        $student = Student::with('user')->findOrfail($student_id);

        $tests = Enrolment::join('enrolment_subjects as es','es.enrolment_id','enrolments.id')
                          ->join('student_grades as sg','sg.enrolment_subject_id','es.id')
                          ->join('grades as g','g.id','sg.grade_id')
                          ->join('subjects as s','s.id','g.subject_id')
                          ->select('s.name as subject_name','g.type as type','g.name as name','sg.score as score','sg.percentage as percentage','g.number_of_items as number_of_items')
                          ->orderBy('sg.created_at','desc')
                          ->get();

        // return $tests;

        return view('portal.grades',compact('student','tests'));
    }
}
