<?php
/**
 * Created by PhpStorm.
 * User: vamos
 * Date: 3/5/17
 * Time: 5:38 PM
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Models\Category;
use App\Core\Session;

class CategoryController extends Controller implements ResourceInterface
{


    public function index()
    {
        $cats=Category::all();
        return view('admin/cat',['cats'=>$cats]);
        //var_dump($cats);
    }

    public function create()
    {
        $cats=Category::all();
        return view('admin/cats/create',['cats'=>$cats]);
    }

    public function store(Request $request)
    {


        $errors = $this->validator->validate($request, [
            'name' => 'required',

        ]);



        if ($errors) {
            $request->saveToSession($errors);
            dispalyForDebug();
            redirect('cats/create', ['errors'=>$request->getLastFromSession()]);
        }else {

            $category = new Category();
            $category->name = $request->get('name');


            // dispalyForDebug($category);die();
            $category->save();
            Session::set('message',"Category Added Successfully");
            redirect('cats/create');
        }


        dispalyForDebug($errors);die();


    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        $category=Category::retrieveByPK($id);
        $category->delete();
        Session::set('message',"Category Deleted Successfully");
    }
}