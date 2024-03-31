<?php

namespace App\Http\Controllers\Auth;

// use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {

        $token = session()->has('token') ? session('token') : $token;
        if (PasswordReset::where('token', $token)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'pageTitle' => 'Reset Password']
        );
    }

    public function reset(Request $request)
    {

        $request->validate($this->rules(), $this->validationErrorMessages());
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if (!$reset) {
            $notify[] = ['error', 'Invalid verification code'];
            return redirect()->route('user.login')->withNotify($notify);
        }

        $user = User::where('email', $reset->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();



        // $userIpInfo = getIpInfo();
        // $userBrowser = osBrowser();
        // sendEmail($user, 'PASS_RESET_DONE', [
        //     'operating_system' => @$userBrowser['os_platform'],
        //     'browser' => @$userBrowser['browser'],
        //     'ip' => @$userIpInfo['ip'],
        //     'time' => @$userIpInfo['time']
        // ]);

        return redirect()->route('login')->with('success','Password changed successfully');
    }



    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        $password_validation = Password::min(8);
        // $general = GeneralSetting::first();
        // if ($general->secure_password) {
        //     $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        // }
        return [
            'token' => 'required',
            'password' => ['required','confirmed',$password_validation],
        ];
    }

}