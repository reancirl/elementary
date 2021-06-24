<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{Student, GradeLevel, User, StudentParent};

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::orderBy('last_name')->get();
        $gls = GradeLevel::get();
        return view('students.index', compact('request', 'gls', 'students'));
    }

    public function create()
    {
        $gls = GradeLevel::get();
        $last_increment = substr(Student::count() ?? 0, -5);
        $student_id_number = now()->year . "-" . str_pad($last_increment + 1, 5, 0, STR_PAD_LEFT);
        return view('students.create', compact('gls', 'student_id_number'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_number' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => '',
            'gender' => 'required',
            'address' => '',
            'birthday' => '',
            'grade_level_entered' => '',
        ]);

        $middle_name = $request->middle_name ? ' ' . ucwords($request->middle_name) : '';

        $exist_email = User::where('email', 'LIKE', '%' . $request->email . '%')->count();
        if ($exist_email > 0) {
            $email = ($exist_email + 1) . '.' . $request->email;
        } else {
            $email = $request->email;
        }

        $last_increment = substr(Student::count() ?? 0, -5);
        $student_id_number = now()->year . "-" . str_pad($last_increment + 1, 5, 0, STR_PAD_LEFT);

        $user = new User;
        $user->name = ucwords($data['last_name']) . ', ' . ucwords($data['first_name']) . $middle_name;
        $user->email = $email;
        $user->password = Hash::make($student_id_number);
        $user->save();
        $user->assignRole('student');

        $student = new Student;
        $student->user_id = $user->id;
        $student->created_by = auth()->user()->id;
        $student->fill($data);
        $student->save();

        $parent = new StudentParent;
        $parent->student_id = $student->id;
        $parent->mothers_maiden_name = $request->mothers_maiden_name;
        $parent->fathers_name = $request->fathers_name;
        $parent->parents_contact_number = $request->parents_contact_number;
        $parent->emergency_contact_person = $request->emergency_contact_person;
        $parent->emergency_contact_number = $request->emergency_contact_number;
        $parent->emergency_contact_person_relationship = $request->emergency_contact_person_relationship;
        $parent->emergency_contact_address = $request->emergency_contact_address;
        $parent->save();

        if($request->parent_email) {
            $user_parent = new User;
            $user_parent->name = ($parent->fathers_name ?? $parent->mothers_maiden_name) ?? 'N/a';
            $exist = User::where('email',$request->parent_email)->first();
            if ($exist) {
                $exist_count = User::where('email',$request->parent_email)->count() + 1;
                $parent_email = $exist_count.'.'.$request->parent_email;
            } else {
                $parent_email = $request->parent_email;
            }
            $user_parent->email = $parent_email;
            $user_parent->password = Hash::make('temporary');
            $user_parent->save();
            $user_parent->assignRole('parent');
        }

        return redirect('/students')->with('success', 'Successfully added!');
    }

    public function show(Student $student)
    {
        $gls = GradeLevel::get();
        return view('students.show', compact('student', 'gls'));
    }

    public function edit(Student $student)
    {
        $gls = GradeLevel::get();
        return view('students.edit', compact('student', 'gls'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'id_number' => '',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => '',
            'gender' => 'required',
            'address' => '',
            'birthday' => '',
            'grade_level_entered' => '',
        ]);

        $student->fill($data);
        $student->save();

        $middle_name = $request->middle_name ? ' ' . ucwords($request->middle_name) : '';

        $user = $student->user;
        $user->email = $request->email;
        $user->name = ucwords($data['last_name']) . ', ' . ucwords($data['first_name']) . $middle_name;
        $user->save();

        $parent = $student->parent;
        if (!$parent) {
            $parent = new StudentParent;
        }
        $parent->student_id = $student->id;
        $parent->mothers_maiden_name = $request->mothers_maiden_name;
        $parent->fathers_name = $request->fathers_name;
        $parent->parents_contact_number = $request->parents_contact_number;
        $parent->emergency_contact_person = $request->emergency_contact_person;
        $parent->emergency_contact_number = $request->emergency_contact_number;
        $parent->emergency_contact_person_relationship = $request->emergency_contact_person_relationship;
        $parent->emergency_contact_address = $request->emergency_contact_address;
        $parent->save();

        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function destroy(Student $student)
    {
        //
    }
}
