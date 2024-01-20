<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccessToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    
    public function login()
    {
        return view('auth.login');
    }

    public function loginuser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with('failed', 'User does not exist. Create an account first.');
        }
    
        if (Hash::check($request->password, $user->password)) {
            if ($user->role == 1) {
                $request->session()->put("userDetails", $user);
                return redirect('/home')->with('success', 'Login Success');
            } elseif ($user->role == 2) {
                $request->session()->put("experts", $user);
                return redirect('/test')->with('success', 'Login Success');
            } else {
                // $request->session()->put("admin", $user);
                return redirect('/')->with('success', 'Login Success');
            }
        } else {
            // Check for password mismatch
            return redirect()->back()->with('failed', 'Invalid password. Please check your password and try again.');
        }
        
    }
    
    

    public function logout()
    {
        if(session()->has('userDetails')){
            session()->flush();
            return redirect('/');
        }else if(session()->has('experts')){
            session()->flush();
            return redirect('/');
        }else if(session()->has('admin')){
            session()->flush();
            return redirect('/');
        }else{
            return redirect('/');
        }

    }

    public function change_profile(){
        $user = User::where('role', '1')->first();
        return view('auth.change-profile',compact('user'));
    }

    public function changeprofile($id){
        $user = User::findOrfail($id);
        return view('auth.update-profile',compact('user'));

    }

public function profile_update(Request $request){

    $userData = [];

    if ($request->filled('name')) {
        $userData['name'] = $request->name;
    }

    if ($request->filled('email')) {
        $userData['email'] = $request->email;
    }
    if ($request->filled('number')) {
        $userData['number'] = $request->number;
    }

    User::where('id', $request->id)->update($userData);

    return redirect('change-profile')->with('success', 'Profile updated successfully');

}




public function reset_pass($id){
    $data= User::where('role', '1')->first();

    return view('auth.reset-password',compact('data'));

}


public function update_password(Request $request){
$request->validate([
    'old_password'        =>'required',
    'new_password'         =>'required',
    'confirm_password' => 'required|same:new_password',
 ]);

  $user  = User::find($request->id);

 $user_pass = $user->password;

if(Hash::check($request->old_password, $user_pass)){

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect('change-profile')->with('success','change your password successfully');

}else{

    return redirect()->back()->with('fail', 'Old password is incorrect');
}

}

}