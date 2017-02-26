<?php

namespace App\Http\Controllers\Auth;

use App\Models\Password;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function askToken(Request $request) {
        $email = $request->get('email');
      //  $user = User::where('email', $email)->first();
        $token = str_random();
        $pass = new Password();
        $pass->email = $email;
        $pass->token = $token;
        $pass->save();

        $subject = "Forget Password";
        $res = Mail::send('email.token', ['token' => $token], function($message) use ($subject, $email) {
            // note: if you don't set this, it will use the defaults from config/mail.php
            $message->from('supervision@test.com', 'Supervision');
            $message->to($email, 'Sanjidul Hoque')
                ->subject($subject);
        });
        if($res == null) {
            return response()->json(['success'=>1,'message'=>'Check mail to get token']);
        }
        return response()->json(['success'=>0,'message'=>'Problem with generating token. Retry']);
    }

    public function validateToken(Request $request) {
        $token = $request->get('token');
        $pass = Password::where('token', $token)->first();
        $today = Carbon::now();
        $diff = date_diff($pass->created_at, $today);
        $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
        if($total> 300) {
            return response()->json(['success'=>0,'message'=>'Token expired. Ask for token again']);

        }
        $user = User::where('email', $pass->email)->first();
        return response()->json(['id' => $user->id,'success'=>1,'message'=>'token validated. now reset password']);

    }

    public function resetPassword(Request $request) {
        $userID = $request->get('user_id');
        $pass = bcrypt($request->get('password'));
        $user = User::find($userID);
        $user->password=$pass;
        $user->update();
        return response()->json(['success'=>1,'message'=>'password updated']);

    }
}
