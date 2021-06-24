<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::get();
        return view('announcements.index',compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'body' => 'required',
        ]);

        $ann = new Announcement;
        $ann->fill($data);
        $ann->save();

        return redirect('/announcements')->with('success','Successfully added!');
    }

    public function show(Announcement $announcement)
    {
        //
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit',compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'body' => 'required',
        ]);

        $announcement->fill($data);
        $announcement->save();

        return redirect()->back()->with('success','Successfully updated!');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect('/announcements')->with('success','Successfully deleted!');
    }
}
