<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Lib\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show login page
     * @param  Request $request [description]
     * @return [type]           [description]
     * @route  GET  {{be}}/login
     */
    public function login(Request $request)
    {
        if (session('token')) {
            return redirect(url('/'));
        }
        $page_title = 'Login';
        return view('auth.login', compact('page_title'));
    }

    /**
     * Show login page
     * @param  Request $request [description]
     * @return [type]           [description]
     * @route  POST  {{be}}/login
     */
    public function processLogin(Request $request)
    {
        if (session('token')) {
            return redirect(url('/'));
        }

        $post_login = MyHelper::postLogin($request);

        if (isset($post_login['errors']) ) {

            return redirect('login')->withErrors($post_login['errors'])->withInput();

        } elseif (isset($post_login['status']) && $post_login['status'] == "failed") {

            return redirect('login')->withErrors($post_login['message'])->withInput();

        } else if (!($post_login['token'] ?? false) || isset($post_login['errors'])) {

            return redirect('login')->withErrors(['invalid_credentials' => 'Invalid username / password'])->withInput();

        } else {
            session([
                'token'         => 'Bearer '.$post_login['token'],
                'email'         => $request->email,
            ]);

            $user_data = $post_login['data']??[];

            if(!$user_data) {
                session()->flush();
                return redirect('login')->withErrors(['Failed get user data'])->withInput();
            }

            $data_to_save = [
                'id_user'          => $user_data['id'],
                'id_anggota'        => $user_data['anggota']['id']??0,
                'name'             => $user_data['name'],
                'roles'             => $user_data['role_array'],
            ];

            session($data_to_save);
        }
        return redirect('/');
    }

    /**
     * Logout from current session / clear all session data
     * @return Redirect     redirect to login page
     * @route   POST/GET    {{be}}/logout
     */
    public function logout()
    {
        MyHelper::apiPost('logout',[]);
        session()->flush();
        return redirect('login')->with([
            'message',
            'Sukses Logout'
        ]);
    }
    public function reset(Request $request, $id)
    {
        $token = $id;
        return view('auth.passwords.reset')->with(['token' => $token]);
    }

    public function forgot()
    {
        return view('auth.passwords.forgot');
    }

    public function forgotPost(Request $request)
    {
        $data = [
            'email' => $request->email,
        ];
        $sendNewPassword = MyHelper::apiPost('forgot-password', $data);
        // return $sendNewPassword;
        if(isset($sendNewPassword['status'])) {
            if($sendNewPassword['status'] == 'failed') {
                return redirect()->back()->with('error', $sendNewPassword['message']);
            } else {
                return redirect()->back()->with('message', $sendNewPassword['message']);
            }
        }
        return redirect()->back()->withErrors($sendNewPassword['errors'])->withInput();
    }
    public function resetPassword(ResetRequest $request)
    {
        $data = [
            'token' => $request->token,
            'password'  => $request->password,
            'password_confirmation'  => $request->password_confirmation,
        ];

        $sendNewPassword = MyHelper::apiPost('forgot-password/reset', $data);
        // return $sendNewPassword;
        if(isset($sendNewPassword['status'])) {
            if($sendNewPassword['status'] == 'failed') {
                return redirect()->back()->with('error', $sendNewPassword['message']);
            } else {
                return redirect()->route('reset.success')->with('message', $sendNewPassword['message']);
            }
        }
        return redirect()->back()->withErrors($sendNewPassword['errors'])->withInput();

    }

    public function resetSuccess()
    {
        return view('auth.success_reset_password');
    }
}