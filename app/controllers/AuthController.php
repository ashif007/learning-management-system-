<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helper;
use App\Core\Request;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{

    public function showlogin()
    {
        if (Session::isLogin()) {
            redirect('/users');
        }
        return view('auth/login');

    }
    public function admin()
    {
        if(Session::isLogin()&&Session::getLoginUser()->role=='admin'){
            return view('auth/admin');
        }else{
            return view('errors/503',['message'=>'Your not allowed to be here!']);
        }

    }

    public function login(Request $request)
    {
        if (verifyCSRF($request)) {
            $errors = $this->validator->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            if(!$errors){
                $user = User::retrieveByEmail($request->get('email'))[0];
                if ($request->get('email') == $user->email && password_verify($request->get('password'), $user->password)) {
                    if($user->isbaned==1){
                        $errors['login'] = "Your have been banned from login into the web site";
                        $request->saveToSession($errors);
                        redirect('/login', $request->getLastFromSession());
                    }else{
                        Session::saveLogin($user->username, $user->role, $user->password);
                        if($request->get('remember')){
                            Session::rememberLogin($user->username, $user->role, $user->password);
                        }
                    }

                } else {
                    $errors['login'] = "Wrong password or login";
                }
            }

            if ($errors) {
                $request->saveToSession($errors);
                redirect('/login', $request->getLastFromSession());
            } else {
                redirect('/');
            }
        } else {
           return view('errors/503',['message','You not allowed to do this action']);
        }
    }

    public function logout()
    {
        Session::destroy();
        Session::forgetLogin();
        redirect('/');
    }

    public function showregister(Request $request)
    {
        if (Session::isLogin()) {
            redirect('/');
        }
        return view('auth/register');
    }

    public function register(Request $request)
    {
        if (verifyCSRF($request)) {
            $errors = $this->validator->validate($request, [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'confirm' => 'required|min:8'
            ]);
            if ($request->get('password') !== $request->get('confirm')) {
                $errors['login'] = "Password not match";
            }
            if (!empty(User::retrieveByEmail($request->get('email')))) {
                Session::set('error', "User already exists");
                redirect('/users/create', $request->getLastFromSession());
            } else {
                if ($errors) {
                    $request->saveToSession($errors);
                    redirect('/users/create', $request->getLastFromSession());
                } else {
                    $user = new User();
                    $user->username = $request->get('username');
                    $user->email = $request->get('email');
                    $user->password = password_hash($request->get('password'), PASSWORD_DEFAULT);
                    $user->created_at = date("Y-m-d H:i:s");
                    $user->updated_at = date("Y-m-d H:i:s");
                    $user->save();
                    redirect("/login");
                }
            }
        }
    }
}