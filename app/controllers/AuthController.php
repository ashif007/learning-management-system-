<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DB\ORM;
use App\Core\Helper;
use App\Core\Request;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{

    public function showlogin()
    {
        if (Session::isLogin()) {
            if (Session::isLogin()&&Session::getLoginUser()->role == "admin")
                redirect('/users');
            else
                redirect('/users/'.Session::getLoginUser()->id);
        }
        else
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
                    if ($user->state != "active")
                    {
                        Session::set('error',"Your account not active <br/>please go to your mail to verify you account");
                        redirect('/login', $request->getLastFromSession());

                    }
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
                redirect('/register', $request->getLastFromSession());
            } else {
                if ($errors) {
                    $request->saveToSession($errors);
                    redirect('/register', $request->getLastFromSession());
                } else {
                    $user = new User();
                    $user->username = $request->get('username');
                    $user->email = $request->get('email');
                    $user->code = md5(mt_rand());
                    $user->password = password_hash($request->get('password'), PASSWORD_DEFAULT);
                    $user->created_at = date("Y-m-d H:i:s");
                    $user->updated_at = date("Y-m-d H:i:s");
                    $user->save();
                    $id = $user->getLastInserted();
                    Session::set('message',"Your account created <br/> we sent confimation message to your registration mail <br> please go to your mail to verify you account");
                    $subject = "Welcome TO Our Learning Platform";
                    $body = 'Hi <b>'.$user->username.'</b> <br/>
                             Your login Information is:<br/>
                             <h3>email: <b>'.$user->email.'</b> </h3>
                             <h3>user : <b>'.$user->username.'</b> </h3>
                             <h3>creation date : <b>'.$user->created_at.'</b></h3>
                             actaivation Link
                             <a href="http://localhost:3000/activation?id='.$id.'&code='.$user->code.'&mail='.$user->email.'">click here to activate your acount</a><br/>
                             this link for one use only
                            ';
                    sendMail($user->email,$user->username,$subject,$body);
                    redirect("/login");
                }
            }
        }
    }

    public function  activeIt(Request $request)
    {

        $user = User::retrieveByEmail($request->get('mail'))[0];
        if ($user->id == $request->get('id') && $user->code == $request->get('code') &&  $user->email == $request->get('mail'))
        {
            $user->code = null;
            $user->state = "active";
            $user->role="student";
            $user->isbaned = 0;
            $user->online = 0;
            $user->update();
            Session::saveLogin($user->username, $user->role, $user->password);
            Session::set('message', "Your acount activated successfully <br/> please update your acount info");
            redirect('/users/'.$user->id);

        }
        else{
            redirect('/login');
        }
    }
}