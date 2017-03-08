<?php
namespace App\Controllers;
use App\Core\App;
use App\Core\Controller;
use App\Core\RSS;

class PagesController extends Controller {

    public function admin()
    {
        return view('admin/layout');
    }

    public function home()
    {
        return view('pages/home');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }



    public function rss()
    {
        $rss=new RSS('salama.com',App::get('config')['rss'],'salama.com','salama.com',true);
        header('Content-Type: application/rss+xml; charset=utf-8');
        echo $rss->create_feed();
    }

}
