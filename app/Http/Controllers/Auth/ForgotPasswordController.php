<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    private function sendSmtpMail($receiver_email, $receiver_name, $subject, $message)
    {
        $config = [
            'host'=> 'smtp.gmail.com',
            'port'=> '465',
            'username'=> 'dev.brainverse@gmail.com',
            'password'=> 'hacd ijtp fbmm naso',
            'enc'=> 'ssl',
        ];

        $mail = new PHPMailer(true); // Create a new PHPMailer instance

        try {
            // Server settings
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host       = $config['host']; // SMTP server host
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = $config['username']; // SMTP username
            $mail->Password   = $config['password']; // SMTP password
            if ($config['enc'] == 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable SSL encryption
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            }
            $mail->Port = $config['port']; // SMTP port
            $mail->CharSet = 'UTF-8'; // Set character encoding

            // Sender
            $mail->setFrom('myapi@mail.com', 'My Api'); // Set sender's email and name
            
            // Recipients
            $mail->addAddress($receiver_email, $receiver_name); // Add recipient
            $mail->addReplyTo('myapi@mail.com', 'My Api'); // Set reply-to address

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject; // Set email subject
            $mail->Body    = $message; // Set email body

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            // Handle any exceptions
            throw new Exception($e);
        }
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
            return back()->with('error', 'User not found.');
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = $this->verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $subject = 'Verification Code';
        $message = 'Your verification code is '. $code ;

        try {
            $this->sendSmtpMail($user->email, $user->name, $subject, $message);
            $pageTitle = 'Account Recovery';
            $email = $user->email;
            session()->put('pass_res_mail',$email);
            return redirect()->route('password.code.verify')->with('success','Password reset email sent successfully');
        } catch (Exception $e) {
            $pageTitle = 'Account Recovery';    $email = $user->email;
            session()->put('pass_res_mail',$email);        
            return redirect()->route('password.code.verify')->with('success','SMTP Error, Use Code '.$code);
        }

        // $userIpInfo = getIpInfo();
        // $userBrowserInfo = osBrowser();
        // sendEmail($user, 'PASS_RESET_CODE', [
        //     'code' => $code,
        //     'operating_system' => @$userBrowserInfo['os_platform'],
        //     'browser' => @$userBrowserInfo['browser'],
        //     'ip' => @$userIpInfo['ip'],
        //     'time' => @$userIpInfo['time']
        // ]);

        
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