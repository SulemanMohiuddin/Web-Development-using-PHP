<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\students;
class LoginController extends Controller
{
    public function show(): View
    {
        return view('signin');
    }
    public function redirect(Request $req)
    {
        $req->validate([
            'id'=>'required',
            'password'=>'required'
        ]);
        $user = students::where('id','=',$req->id)->first();
        if($user && $user->password==$req->password){   
            session(['type' => $user->type]);
            session(['id' => $req->id]);
            if($user->type=='student'){
                return redirect()->route('dashboard2');
            }
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->withErrors(['loginError' => 'Invalid username or password']);
        }
    }
    public function regs(Request $req)
    {
        $req->validate([
            'id'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $user['id']=$req->id;          
        session(['type' => 'student']);
        session(['id' => $req->id]);
        $user['email']=$req->email;
        $user['password']=$req->password;
        $users = students::insert($user);
        if($users){
            return redirect()->route('dashboard2');
        }else{
            return redirect()->route('register')->withErrors(['loginError' => 'Invalid credentials']);
        }
    }
    
}
