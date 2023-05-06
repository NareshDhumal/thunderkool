<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer;
use DB;
use Session;

class FrgtpassController extends Controller
{
    public function frgtpassword()
    {
        return view('backend.account.forget_password');
    }

    public function sendotp(Request $request)
    {


        // dd($request->all());
        $this->validate(request(), [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ]);
        // $user = Admin::get();
        $user = Admin::where('email', $request->email)->first();
        //   $user = $request->admin_user_id;

        if ($user == null) {
            // Session::flash('error', 'Incorrect Email!');

            return redirect()->route('frgtpassword')->with('error','Invalid Email Address');
        }
        try {
            //             $token = random();
            // dd($token);
            $email = $request->email;
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            // dd($randomString);
            // return $randomString;
            $mail = new PHPMailer\PHPMailer();
            $mail->IsSMTP();

            $mail->CharSet = "utf-8"; // set charset to utf8
            //   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            //for live start
            // $mail->Host       = "localhost";
            // $mail->SMTPSecure = "tls";
            // $mail->SMTPDebug  = 0;
            // $mail->SMTPAuth   = false;
            // $mail->Mailer     ="smtp";
            // $mail->Port       = 25;
            // $mail->Username = "";
            // $mail->Password = '';
            //for live end

            //for local start
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // or 465
            $mail->Username = "irfanp@parasightsolutions.com";
            $mail->Password = 'irf@np@th@n7778';
            //for local end
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);
            $mail->SetFrom('info@podar.com', 'ThunderKool');
            $mail->AddAddress($email);
            $mail->Subject = "Passowrd Reset link";
            // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
            $mail->Body = 'Password reset <a href="' . url("/resettoken/" . $randomString) . '">Click Here to change Password</a>';
            $mail->Send();
            Session::put('email', $email);
            Session::put('id ', $user->id);

            if ($user->otp != null) {
                $user = DB::table('admin')
                    ->where('email', $email)
                    ->update(array(
                        'token' => $randomString
                    ));
            } else {
                $user->token = $randomString;
                $user->save();
            }


            // return redirect()->route('passwordform',['email'=>$email]);
            // view('frontend.users.login_password',compact('email'));
            //return view('frontend.users.otp',compact('email'));

            return redirect()->to('/thankyou')->with('success', 'Link Has Sent To Your Email');

            return redirect()->to('/resettoken/' . $randomString)->with('success', 'Mobile Number Verified Successfully');
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function showResetPasswordForm(request $request)
    {
        
        $resetdata = Admin::where('token', $request->token)->get();
        // dd($resetdata);
        if (isset($request->token) && count($resetdata) > 0) {
            $user = Admin::where('email', $resetdata[0]['email'])->get();

        }
        return view('backend.account.setpasswordform', compact('user'));
    }



    public function forthankyou()
    {
        return view('backend.account.thankyou');
    }

    public function changeforgotpassword(request $request)
    {

        // dd($request->all());
        $this->validate(request(), [
            'password' => 'min:6|required_with:password_conformation|same:password_conformation',
            'password_conformation' => 'required|min:6',

        ]);

        $user = Admin::find($request->id);
        $user->password = ($request->password);
        // dd($user);
        $user->save();

        return redirect()->to('admin/login')->with('success', 'password changed succesfully');

    }
}
