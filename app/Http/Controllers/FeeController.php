<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $fees = Fee::with('student.user','enrolment.section.gradeLevel');
        if($request->keyword) {
            $keyword = $request->keyword;
            $fees = $fees->with(['student' => function ($query) use ($keyword){
                $query->where('id_number', 'LIKE','%'.$keyword.'%')
                      ->orWhere('last_name', 'LIKE','%'.$keyword.'%')
                      ->orWhere('first_name', 'LIKE','%'.$keyword.'%')
                      ->orWhere('middle_name', 'LIKE','%'.$keyword.'%');
            }]);
        }
        $fees = $fees->get();
        return view('fees.index',compact('fees','request'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Fee $fee)
    {
        //
    }

    public function edit(Fee $fee)
    {
        //
    }

    public function update(Request $request, Fee $fee)
    {
        //
    }

    public function destroy(Fee $fee)
    {
        //
    }
}
