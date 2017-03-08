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
            'title' => 'required',
            'desc' => 'required',
            'start' => 'required',
            'end' => 'required',
            'cat' => 'required',
            'rank' => 'required',
        ]);

        if ($errors) {
            $request->saveToSession($errors);

            redirect('courses/create', ['errors'=>$request->getLastFromSession()]);
        }else {

            $course = new Course();
            $course->title = $request->get('title');
            $course->description = $request->get('desc');
            $course->start = $request->get('start');
            $course->end = $request->get('end');
            $course->cid = $request->get('cat');
            $course->rate = $request->get('rank');
            $course->tid =2; // dummy
            $course->image ="dumy";

//            try {
//                dispalyForDebug($request->getfile("image"));
//                die();
//                $files = upload($request->getfile("image"));
//                $course->image = $files['metas'][0]['name'];
//            } catch (\Exception $e) {
//                $e->getMessage();
//            }
            // dispalyForDebug($course);die();
            $course->save();
            Session::set('message',"User Added Successfully");
            redirect('courses/create');
        }

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
    }
}