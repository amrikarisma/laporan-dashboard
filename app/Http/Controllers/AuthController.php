<?php

namespace App\Http\Controllers;

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

        } elseif (isset($post_login['status']) && $post_login['status'] == "fail") {

            return redirect('login')->withErrors($post_login['messages'])->withInput();

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
                'name'             => $user_data['name'],
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
}