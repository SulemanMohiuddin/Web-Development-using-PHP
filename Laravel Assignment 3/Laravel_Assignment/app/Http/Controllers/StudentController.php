<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\attends;
use App\Models\assigncourses;
use App\Models\enrolleds;
use App\Models\marks;
use App\Models\students;

class StudentController extends Controller
{
    public function info()
    {
        $info = students::where('id','=', session('id'))->get();
        return view('user_profile', compact('info'));
    }
    public function marks()
    {
        $marks = marks::where('sid','=', session('id'))->get();
        return view('view_marks', compact('marks'));
    }
    public function attend()
    {
        $attends = attends::where('sid','=', session('id'))->get();
        return view('view_attendance', compact('attends'));
    }
    public function reg()
    {
        $courses = assigncourses::all();
        return view('register_course', compact('courses'));
    }
    public function sub(Request $request)
    {
        $cId = $request->input('cid');
        $courses = assigncourses::where('cid','=', $cId)->first();
        if($courses) {
            $val['cid'] = $cId;
            $val['tid'] = $courses->sid;
            $val['sid'] = session('id');
            enrolleds::insert($val);
            return view('stdhome');
        } else {
            return redirect()->back()->with('error', 'Course not found!');
        }
    }
}
