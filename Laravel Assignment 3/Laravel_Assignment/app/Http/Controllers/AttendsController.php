<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\enrolleds;
use App\Models\marks;
use App\Models\assigncourses;


class AttendsController extends Controller
{
    public function selectCourse()
    {
        $courses = assigncourses::where('sid', session('id'))->get();
        return view('attendance_assign', compact('courses'));
    }
    public function addAttend(Request $request)
    {
        $courseId = $request->input('cid');
        $teacherId = session('id');
        $date=$request->date;
        $enrolledStudents = enrolleds::where('cid', $courseId)->where('tid', $teacherId)->get();

        return view('add_attendance', compact('enrolledStudents','date'));
    }
    public function submitAtten(Request $request)
    {
        $studentId = $request->input('student_id');
        $attendance = $request->input('attendance');
        return response()->json(['success' => true]);
    } 
    public function marks(Request $request)
    {
        $courses = assigncourses::where('sid', session('id'))->get();
        return view('assign_marks', compact('courses'));
    }  
    public function addMarks(Request $request)
    {
        $courseId = $request->input('cid');
        $teacherId = session('id');
        $enrolledStudents = enrolleds::where('cid', $courseId)->where('tid', $teacherId)->get();

        return view('add_marks', compact('enrolledStudents','courseId'));
    }
    public function submitMarks(Request $request)
    {
        
        $val['cid'] = $request->input('cid');
        $val['sid'] = $request->input('sid');
        $val['tid']=session('id');
        $val['marks'] = $request->input('marks');
        $enrolledStudents = marks::insert($val);

        return redirect()->back()->with('success', 'Marks added successfully!');
    } 

}
