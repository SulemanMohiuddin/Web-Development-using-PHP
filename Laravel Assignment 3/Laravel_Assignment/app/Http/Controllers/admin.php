<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\students;
use App\Models\course;
use App\Models\assigncourses;
class admin extends Controller
{
    public function show():View
    {
        $students = students::all();
        return view('update', compact('students'));
    }
    public function index() :View
    {
        return view('faculty_sidebar');
    }
    public function index2() :View
    {
        return view('student_sidebar');
    }
    public function update(Request $request, $id)
    {
        $student = students::findOrFail($id);
        $student->update($request->only(['email', 'password']));
        return redirect()->route('update')->with('success', 'Student information updated successfully!');
    }
    public function delete($id)
    {
        $student = students::findOrFail($id);
        $student->delete();
        return redirect()->route('update')->with('success', 'Student deleted successfully!');
    }
    public function offer() :View
    {
        return view('course_offer');
    }
    public function course(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        course::create([
            'courseid' => $request->id,
            'name' => $request->name
        ]);

        return redirect()->route('offer.course')->with('success', 'Course offered successfully!');
    }

    public function showAssignForm()
    {
        $courses = course::all();
        $students = students::where('type','=','faculty')->get();
        return view('give_courses', compact('courses', 'students'));
    }

    public function assignCourses(Request $request)
    {
        $request->validate([
            'cid' => 'required',
            'tid' => 'required',
        ]);
        $ids['sid']=$request->input('tid');
        $ids['cid']=$request->input('cid');
        $chk=assigncourses::insert($ids);
        if($chk){
            return redirect()->route('assign.courses')->with('success', 'Course assigned successfully!');
        }else{
            return redirect()->route('assign.courses')->with('success', 'Error');
        }

    }
}
