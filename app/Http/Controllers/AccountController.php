<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Services\MailerService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AccountController extends Controller
{

    /**
     * @var MailerService
     */
    private $mailerService;

    /**
     * ProductController constructor.
     * @param MailerService $mailerService
     */
    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function resetPasswordWithToken (Request $request)
    {
        $email = $request->all()['email'];
        $user_id = User::where('email', $email)->get('id');
        $date = date('d/m/Y h:i:s', time());
        /*$token = array(
            "user_id" => base64_encode ($user_id),
            "date" => base64_encode ($date)
        );
        $token_reset_password = json_encode($token);*/
        $token_reset_password = base64_encode($user_id);

        DB::table('users')->where('email', '=', $email)->update([
            'token_reset_password' => $token_reset_password
        ]);

        if ($this->sendResetEmail($email, $token_reset_password)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }


    /**
     * Encode le token avec user_id & time_stamp avec (h+1 création)
     * Encode en Base64
     * Notion JWT (JSon Web Token)
     */

    /**
     * @param $email
     * @param $token
     * @return bool|void
     * @throws \Throwable
     */
    private function sendResetEmail($email, $token)
    {
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        try {
            $response = $this->mailerService->sendMail(
                [
                    'Email' => $email,
                    'Name' => 'e_commerce'
                ], 'Reset Password', 'mails.mailLinkReset', [
                    'user' => $user,
                    'link' => route('changePasswordLink', ['token' => $token])
                ]);

            return true;
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordLink ($token)
    {
        return view('mails.resetPassword')->with('token',$token);
    }


    /**
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        //Validate input
        $params = $request->validated();
        $password = $request->password;

        // Validationd du token
        $tokenData = User::where('email', $params['email'])->get()[0];
        $token = $tokenData['token_reset_password'];


        // Redirect the user back to the password reset request form if the token is invalid
        if (!$token) throw new NotFoundResourceException('!$tokenData');
        if ($token != $params['token'])  return redirect()->route('home');;

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);

        //Hash and update the new password
        $user->password = Hash::make($password);
        $update = $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);
        
        //Send Email Reset Success Email
        if ($update) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }
}
