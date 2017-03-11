<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 28/02/17
 * Time: 11:50 م
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\Comment;

class CommentController extends Controller implements ResourceInterface
{

    public function index()
    {
        return view('errors/404');
    }

    public function create()
    {
        return view('errors/404');
    }

    public function store(Request $request)
    {
        $comment=new Comment();
        $comment->content=$request->get('body');
        $comment->mid=$request->get('mid');
        $comment->uid=Session::getLoginUser()->id;
        $comment->created_at = date("Y-m-d H:i:s");
        $comment->updated_at = date("Y-m-d H:i:s");
        $comment->save();
        redirect($request->get('url'));
    }

    public function show($id)
    {
        return view('errors/404');
    }

    public function edit($id)
    {
        return view('errors/404');
    }

    public function update(Request $request, $id)
    {
        return view('errors/404');
    }

    public function destroy($id)
    {
       $comment=Comment::retrieveByPK($id);
       $comment->delete();
       redirect(Session::getBackUrl());
    }
}