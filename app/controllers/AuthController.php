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
        return view('auth/admin');
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
                    Session::saveLogin($user->username, $user->role, $user->password);
                    if($request->get('remember')){
                        Session::rememberLogin($user->username, $user->role, $user->password);
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
            echo "not allowed";
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
                redirect('/register', $request->getLastFromSession());
            } else {
                if ($errors) {
                    $request->saveToSession($errors);
                    redirect('/register', $request->getLastFromSession());
                } else {
                    $user = new User();
                    $user->username = $request->get('username');
                    $user->email = $request->get('email');
                    $user->password = password_hash($request->get('password'), PASSWORD_DEFAULT);
                    $user->created_at = date("Y-m-d H:i:s");
                    $user->updated_at = date("Y-m-d H:i:s");
                   // dispalyForDebug($user);
                    $user->save();
                    die();
                    $subject = "Welcome TO Our Learning Platform";
                    $body = "Hi <b>$user->username</b> <br/>
                             Your login Information is:<br/>
                             <h3>email: <b>$user->email</b> </h3>
                             <h3>user : <b>$user->username</b> </h3>
                             <h3>creation date : <b>$user->created_at</b></h3>
                            ";
                    sendMail($user->email,$user->username,$subject,$body);
                    redirect("/login");
                }
            }
        }
    }
}