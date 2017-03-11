<?php
namespace App\Controllers;
use App\Core\App;
use App\Core\Controller;
use App\Core\Request;
use App\Core\RSS;
use App\Core\Session;
use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use App\Models\UserRequest;

class PagesController extends Controller {

    public function admin()
    {

        if(Session::isLogin()&&Session::getLoginUser()->role=="admin"){
            $users=User::all();
            $reqs=UserRequest::all();
            $materials=Material::all();
            $courses=Course::all();
            return view('admin/dashboard',['users'=>$users,'reqs'=>$reqs,'courses'=>$courses,'materials'=>$materials]);
        }else{
            return view("errors/503",['message'=>"You are not allowed to be here!"]);
        }

    }

    public function home()
    {
        return view('pages/home');
    }

    public function about()
    {
        redirect('/#team');
    }

    public function contact()
    {
        redirect('/#contact');
    }



    public function rss()
    {
        $rss=new RSS('salama.com',App::get('config')['rss'],'salama.com','salama.com',true);
        header('Content-Type: application/rss+xml; charset=utf-8');
        echo $rss->create_feed();
    }

}
