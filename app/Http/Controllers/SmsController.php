<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;
use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\Student;

class SmsController extends Controller
{
    public function failedStudents($grading,$section_id,$subject_id) {
        $parents_contact_number = Enrolment::join('enrolment_subjects as es','es.enrolment_id','enrolments.id')
                                ->join('students as s','s.id','enrolments.student_id')
                                ->join('parents as p','p.student_id','s.id')
                                ->where('enrolments.section_id',$section_id)
                                ->where($grading,'<','75')
                                ->where('es.subject_id',$subject_id)
                                ->select('p.id','p.parents_contact_number','es.first_grading_grade','es.second_grading_grade','es.third_grading_grade','es.fourth_grading_grade')
                                ->pluck('p.parents_contact_number');
        
        $parents_phone_numbers = '';
        $count = 0;

        foreach ($parents_contact_number as $i => $p) {
            if($p) {
                $count++;
                if ($count == 1) {
                    $parents_phone_numbers .= $p;
                } else {
                    $parents_phone_numbers .= ','.$p;
                }
            }
        }

        return view('sms.send',compact('parents_phone_numbers','count'));
    }

    public function index(Request $request) {
        $gls = GradeLevel::get();
        return view('sms.index',compact('request','gls'));
    }

    public function searchWithGradeLevel(Request $request) {
        return Section::where('grade_level_id',$request->grade_level)->get();
    }

    public function sendBulk(Request $request) {
        $data = Enrolment::with('student.parent')
                        ->join('sections as s','s.id','enrolments.section_id')
                        ->join('grade_levels as g','g.id','s.grade_level_id')
                        ->select('s.id as section_id','g.id as grade_level_id','enrolments.*');

        if($request->grade_level != 'all') {
            $data = $data->where('g.id',$request->grade_level);

            if($request->section) {
                $data = $data->where('s.id',$request->section);
            }
        }        

        $phone = null;
        $data = $data->get();
        foreach($data as $i => $d) {
            if($i == 0) {
                $phone .= $d->student->parent->parents_contact_number;
            } else {
                $phone .= ', '.$d->student->parent->parents_contact_number;
            }
        }

        return $phone;
    }

    public function searchStudent(Request $request) {
        $data = Student::join('parents as p','p.student_id','students.id')
                        ->select('students.last_name as lname','students.first_name as fname','students.middle_name as mname','p.parents_contact_number as phone');

        if($request->student_first_name) {
            $data = $data->where('students.first_name','LIKE',$request->student_first_name);
        }

        if($request->student_last_name) {
            $data = $data->where('students.last_name','LIKE',$request->student_last_name);
        }

        return $data->get();
    }
}
