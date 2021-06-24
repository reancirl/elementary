<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Enrolment;
use App\Models\Section;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Fee;
use App\Models\StudentParent;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $student_count = Student::count();
        $enrolees_count = Enrolment::where('withdrawn',0)->count();
        $section_count = Section::where('status',1)->count();
        $teachers_count = User::role('teacher')->count();
        $announcements = Announcement::where('status',1)->orderBy('priority')->get();
        $balance = 0;
        $user = auth()->user();
        if($user->hasRole('parent')) {
            $student_id = StudentParent::where('mothers_maiden_name',$user->name)
                                      ->orWhere('fathers_name',$user->name)
                                      ->first()->student_id;
                                      
            $balance = Fee::where('student_id',$student_id)
                          ->sum('remaining_balance');
        }
        return view('dashboard.homepage',compact('student_count','enrolees_count','section_count','teachers_count','announcements','balance'));
    }

    public function search(Request $request)
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function schoolInfo()
    {
        $school = DB::table('school_info')->first();
        return view('schoolInfo',compact('school'));
    }

    public function schoolInfoStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required'
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);

        DB::table('school_info')->truncate();

        DB::table('school_info')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'image' => $imageName
        ]);

        return redirect()->back()->with('success','Successfully Saved');
    }
}
