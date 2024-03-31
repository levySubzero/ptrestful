<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm()
    {
        $pageTitle = "Forgot Password";
        return view('auth.passwords.email', compact('pageTitle'));
    }

    public function createnewpass($userId)
    {
        $pageTitle = "Forgot Password";
        return view(activeTemplate() . 'auth.passwords.createpass', compact('pageTitle', 'userId'));
    }
    public function verification()
    {
        $pageTitle = "Forgot Password";
        return view(activeTemplate() . 'auth.passwords.verification', compact('pageTitle'));
    }

    public function verificationCode($length)
    {
        if ($length == 0) {
            return 0;
        }
        $min = pow(10, $length - 1);
        $max = 0;
        while ($length > 0 && $length--) {
            $max = ($max * 10) + 9;
        }
        return random_int($min, $max);
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $notify[] = ['error', 'User not found.'];
            return back()->withNotify($notify);
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = $this->verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        // $userIpInfo = getIpInfo();
        // $userBrowserInfo = osBrowser();
        // sendEmail($user, 'PASS_RESET_CODE', [
        //     'code' => $code,
        //     'operating_system' => @$userBrowserInfo['os_platform'],
        //     'browser' => @$userBrowserInfo['browser'],
        //     'ip' => @$userIpInfo['ip'],
        //     'time' => @$userIpInfo['time']
        // ]);

        $pageTitle = 'Account Recovery';
        $email = $user->email;
        session()->put('pass_res_mail',$email);
        return redirect()->route('password.code.verify')->with('success','Password reset email sent successfully');
    }

    public function codeVerify(){
        $pageTitle = 'Account Recovery';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error','Oops! session expired'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        return view('auth.passwords.code_verify',compact('pageTitle','email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $code =  str_replace(' ', '', $request->code);

        if (PasswordReset::where('token', $code)->count() != 1) {
            return redirect()->route('password.request')->with('error', 'Invalid token');
        }
        $notify[] = ['success', 'You can change your password.'];
        return redirect()->route('password.reset', $code)->with('success', 'You can change your password.');
    }

}