<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\question;
use App\Models\para;
class UserController extends Controller
{
    public function get_user(){
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
            $users = User::where('role', 0)->get();

            return view("admin.user_table", compact("users"));
        }
    
        
    }

    public function edit_user($id)
    {
        $data = User::findOrFail($id);

        return view('admin.edituser', compact('data'));

    }

    public function user_edit(Request $request)
    {
        

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

        return redirect('users')->with(['success' => 'Users updated successfully']);
    }


public function delete( $id){
    User::where('id', "=", $id)->delete();
    return redirect()->back()->with("success", "Users deleted successfully");
}





}
