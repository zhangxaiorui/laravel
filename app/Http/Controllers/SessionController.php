<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class SessionController extends Controller
{
            //

            public   function  create(){
                return view('session.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ] );
            $email=$request->email;
            $password=$request->password;
//        var_dump($request->has('remember'));exit;
        if (Auth::attempt(['email'=>$email,'password'=>$password],$request->has('remember'))){
            session()->flash('success','欢迎回来');
             return    redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','密码或用户名错误');
            return redirect()->back();
        }


    }

    public function destroy(){
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect('login');
    }
 }
