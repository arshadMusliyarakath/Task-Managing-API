<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrondEndController extends Controller
{
    
    public function login() {
        return (auth()->user()) ? redirect()->route('home') : view("user.login");
    }
    
    public function signup(){
        return (auth()->user()) ? redirect()->route('home') : view("user.signup");
    }
    public function doLogin(){
        $data = [
            'email' => request('email'),
            'password' => request('password'),
        ];
        if(auth()->attempt($data)){
            return redirect()->route('home');
        }
        else{
            return redirect()->route('user.login')->with('loginFailedMessage', 'Invalid Credencials. Please try again!');
        }
    }
    
    public function doSignup(){
        $data = [
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('pass1')),
        ];
        User::create($data);
        return redirect()->route('user.login')->with('signupSuccess', "Accout Created! Please login now");
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('user.login');
    }

    public function home(){
        $userId = auth()->user()->user_id;
        $tasks = Task::where('user_id', $userId)->get();
        return view('home', compact('tasks'));
    }
}
