<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User_Custom;
// use Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

// use Illuminate\Contracts\Session\Session as SessionSession;
// use Illuminate\Support\Facades\Session as FacadesSession;
class CustomAuthController extends Controller
{
   public function login()
   {
    return view("auth.login_custom");
   }
   public function registration()
   {
    return view("auth.registration_custom");
   }
   public function registerUser(Request $request)
   {
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:user__customs',
        'password'=>'required|min:5|max:12'
    ]);
    $user = new User_Custom();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $res = $user->save();
    if($res){
        return back()->with('success', 'You have registered successfuly');
    } else{
        return back()->with('fail', ' Something wrong');
    }
   }
   public function loginUser(Request $request){
    $request->validate([
        'email'=>'required|email|',
        'password'=>'required|min:5|max:12'
    ]);
    $user = User_Custom::where('email', '=', $request->email)->first();
    if($user){
        if (Hash::check($request->password, $user->password)) {
            $request->session()->put('loginId',$user->id);

            return redirect('dashboard')->with('success', 'You have login successfuly');;
        } else {
           return back()->with('fail', 'Password not matches.');
        }

    } else{
        return back()->with('fail', 'This email is not requistered');
    }
   }
//    public function dashboard()
//    {
//     $data = array();
//     if(Session::has('loginId')){
//         $data = User_Custom::where('id', '=', Session::get('loginId'))->first();
//     }
//     return view('pages.home', compact('data'));
//    }
}

