<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function LoginView()
    {
        return view('users.login');
    }

    public function Dashboard()
    {
        return view('users.dashboard');
    }

    public function Users()
    {
        $users = User::get();
        return view('users.users_list', compact('users'));
    }

    public function CheckLogin(Request $request)
    {
        $currentDateTime = now('Asia/kolkata');
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');

        $user = User::where('user_name', $request->user_name)->exists();
        if($user == 1){

            $user_result = User::where('user_name', $request->user_name)->first();
            $user_id = User::where('user_name', $request->user_name)->pluck('id')->first();

            $decrypt_password = Crypt::decrypt($user_result->password);

            if ($request->password != $decrypt_password){

                return redirect()->route('user.login-view');

            }else {

                Attendance::create([
                    'user_id' =>$user_id,
                    'date'    =>$currentDate,
                    'sign_in_time' =>$currentTime,
                    'sign_out_time' =>null,

                ]);

                $request->session()->put('user', $user_result);

                return redirect()->route('user.dashboard')->with('success', 'Login Successfully');

            }
        }

        return redirect()->route('user.dashboard');
    }


    public function Register()
    {
        return view('users.register');
    }
    public function SaveRegister(Request $request)
    {
        User::insert([

            'name'       => $request->name,
            'user_name'  => $request->user_name,
            'password'   =>Crypt::encrypt($request->password),

            ]);

        return redirect()->route('user.login-view');
    }

    public function Logout(Request $request)
    {

        $currentDateTime = now('Asia/kolkata');
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');

        if (session()->has('user')) {
            $user = session()->get('user');
            $user_id = $user->id;
        }
        $attendance_id = Attendance::where('user_id',$user_id)->orderBy('id','desc')->pluck('id')->first();

        Attendance::where('id',$attendance_id)->update([
            'sign_out_time' =>$currentTime,

        ]);

        Session::flush();

        return redirect()->route('user.login-view')->with('error','logout successfully');

    }
}
