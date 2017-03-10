<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:18 م
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\Material;


class PostController extends Controller implements ResourceInterface
{

    public function index()
    {
        $materials=Material::all();
        return view('admin/materials/index',['materials'=>$materials]);
    }

    public function create()
    {
        if (Session::isLogin()) {
            $materials=Material::all();
            return view('admin/materials/index',['materials'=>$materials]);
        } else {
            return view('errors/503', ['message' => "You are not allowed to be here!"]);
        }
    }

    public function store(Request $request)
    {
        if (Session::isLogin()&&Session::getLoginUser()->role=="admin") {
            if (verifyCSRF($request)) {
                $errors = $this->validator->validate($request, [
                    'cid' => 'required',
                    'link' => 'required',
                    'name'=>'required',
                    'type'=>'required'
                ]);

                if ($errors) {
                    $request->saveToSession($errors);
                    Session::set('error', "none valid data");
                    redirect('/materials/create', $request->getLastFromSession());
                } else {
                    $material = new Material();
                    $material->cid = $request->get('cid');
                    $material->name = $request->get('name');
                    $material->type = $request->get('type');
                    if($request->get('type')=='video'){
                        $material->link=$request->get('link');
                    }else{
                        $material->link=upload_file("file");
                    }
                    $material->description=$request->get('description');
                    $material->created_at = date("Y-m-d H:i:s");
                    $material->updated_at = date("Y-m-d H:i:s");
                    $material->save();
                    Session::set('message', "Request Added Successfully");
                    if($request->get('url')){
                        redirect($request->get('url'));
                    }
                    redirect("/courses/$material->cid");
                }
            } else {
                return view('errors/503', ['message' => "You are not allowed to be here!"]);
            }
        }
    }

    public function show($id)
    {
        $material = Material::retrieveByPK($id);
        return view('admin/materials/show', ['material' => $material]);

    }

    public function edit($id)
    {
        if (Session::isLogin()&&Session::getLoginUser()->role=="admin") {
            $material = Material::retrieveByPK($id);
            return view('admin/materials/edit', ['material' => $material]);
        } else {
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }
    }

    public function update(Request $request, $id)
    {
        if (Session::isLogin()&&Session::getLoginUser()->role=="admin") {
            if (verifyCSRF($request)) {
                $errors = $this->validator->validate($request, [
                    'cid' => 'required',
                    'link' => 'required',
                    'name'=>'required',
                    'type'=>'required'
                ]);

                if ($errors) {
                    $request->saveToSession($errors);
                    Session::set('error', "none valid data");
                    redirect('/materials/create', $request->getLastFromSession());
                } else {
                    $material = Material::retrieveByPK($id);
                    $material->cid = $request->get('cid');
                    $material->name = $request->get('name');
                    $material->type = $request->get('type');
                    if($request->get('type')=='video'){
                        $material->link=$request->get('link');
                    }else{
                        $material->link=upload_file("file");
                    }
                    $material->description=$request->get('description');
                    $material->created_at = date("Y-m-d H:i:s");
                    $material->updated_at = date("Y-m-d H:i:s");
                    $material->update();
                    Session::set('message', "Request Added Successfully");
                    if($request->get('url')){
                        redirect($request->get('url'));
                    }
                    redirect("/courses/$material->cid");
                }
            } else {
                return view('errors/503', ['message' => "You are not allowed to be here!"]);
            }
        }
    }

    public function destroy($id)
    {
        if (Session::isLogin()&&Session::getLoginUser()->role=="admin") {
            $material = Material::retrieveByPK($id);
            if($material->type!='video'){
                delete_file($material->link);
            }
            $material->delete();
            Session::set('message', "Material Deleted Successfully");
            redirect(Session::getBackUrl());
        }else{
            return view("errors/503",['message'=>"You are not allowed to be here!"]);
        }
    }
}