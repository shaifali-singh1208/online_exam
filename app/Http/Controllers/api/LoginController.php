<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Carbon;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use Validator, Redirect, Response;

class LoginController extends Controller
{
    public function register_user()
    {
        return view('auth.register');
    }
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|unique:users',
        'password' => 'required|min:5',
    'number' => 'required|integer|min:10', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }
    $subscription=1;
$user = User::create([

    'name' => $request->name,
    'email' => $request->email,
    'number' => $request->number,
    'password' => bcrypt($request->password),
]);


    return response()->json([
        'status' => 'success',
        'message' => 'User registered successfully',
        'data' => $user,
        'subcription'=>$subscription,
        'subcription_s_date'=>$user->subcription_s_date,
        'subcription_e_date'=>$user->subcription_e_date,

        
    ], 201);
}


    public function login()
    {
        return view('auth.login');
    }

public function login_user(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string|min:5',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 0) {
        //    $request->session()->put('id',$user);

            return response()->json([
                'status' => 'success',
                'message' => 'Login Success',
                'data' => [
                    'id' => $user->id,
                          'name' => $user->name,
                       'mobile_number' => $user->number,    
                    'created_at' => $user->created_at,
                    'subscription' => $user->subscription,
                    'subscription_start_date' => $user->subscription_s_date,
                    'subscription_end_date' => $user->subscription_e_date,
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid',
            ], 401);
        }
    }

    // Return a 401 error message if authentication fails
    return response()->json([
        'status' => 'failed',
        'message' => 'Invalid credentials',
    ], 401);
}



    public function logout(Request $request )
    {
        if(session()->has('user')){
            session()->flush();
            return redirect('/login');
        }else if(session()->has('admin')){
            session()->flush();
            return redirect('/login');
        }else{
            return redirect('/login');
        }

    }



}
