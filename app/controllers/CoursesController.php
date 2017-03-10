<?php
/**
 * Created by PhpStorm.
 * User: terminator
 * Date: 3/5/17
 * Time: 4:53 PM
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;

class CoursesController extends Controller implements ResourceInterface
{
    public function index()
    {
        $courses = Course::all();
        return view('admin/courses/index',['courses'=>$courses]);
    }

    public function create()
    {
        if (Session::isLogin()&&Session::getLoginUser()->role == 'admin'){
            $courses = Course::all();
            $cats = Category::all();
            return view('admin/courses/create',['courses'=>$courses, 'cats'=>$cats]);
        }else{
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }
    }

    public function store(Request $request)
    {
        if (Session::isLogin()&&Session::getLoginUser()->role == 'admin') {

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
                redirect('courses/create', ['errors' => $request->getLastFromSession()]);
            } else {
                $course = new Course();
                $course->title = $request->get('title');
                $course->description = $request->get('desc');
                $course->start = $request->get('start');
                $course->end = $request->get('end');
                $course->cid = $request->get('cat');
                $course->rate = $request->get('rank');
                $course->tid = Session::getLoginUser()->id;

                try {
                    $image = uploadFile("image", $_SERVER["DOCUMENT_ROOT"] . "/uploads/", "", time(), getImageTypes());
                    $course->image = $image['name'];
                } catch (\Exception $e) {
                    $e->getMessage();
                }
                $course->save();
                Session::set('message', "User Added Successfully");
                redirect('courses/create');
            }

        }else{
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }


    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function edit($id)
    {
        if(Session::isLogin() && Session::getLoginUser()->role == 'admin') {
            $course = Course::retrieveByPK($id);
            $cats = Category::all();
            return view('admin/courses/edit', ['course' => $course, 'cats' => $cats]);
        }else{
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }
    }

    public function update(Request $request, $id)
    {
        if(Session::isLogin() && Session::getLoginUser()->role == 'admin')
        {
            $course=Course::retrieveByPK($id);
            if(verifyCSRF($request)){
                $errors = $this->validator->validate($request, [
                    'title' => 'required',
                    'desc' => 'required',
                    'start' => 'required',
                    'end' => 'required',
                    'cat' => 'required',
                    'rank' => 'required',
                ]);
            }
            if ($errors)
            {
                $request->saveToSession($errors);
                redirect("/courses/".$course->id.'/edit', $request->getLastFromSession());
            }else{
                $course->title = $request->get('title');
                $course->description = $request->get('desc');
                $course->start = $request->get('start');
                $course->end = $request->get('end');
                $course->cid = $request->get('cat');
                $course->rate = $request->get('rank');
                $course->tid = Session::getLoginUser()->id;
                if ($_FILES['image']['name'])
                {
                    try {
                        $image = uploadFile("image",$_SERVER["DOCUMENT_ROOT"]."/uploads/","",time(),getImageTypes());
                        $course->image = $image['name'];
                    } catch (\Exception $e) {
                        $e->getMessage();
                    }
                }
                $course->update();
                Session::set('message',"Course Updated Successfully");
                redirect('/courses/create');
            }
        }else{
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }
    }

    public function destroy($id)
    {
        if(Session::isLogin() && Session::getLoginUser()->role == 'admin') {
            $course = Course::retrieveByPK($id);
            $course->delete();
            Session::set('message', "Course Deleted Successfully");
        }else{
            return view('errors/503',['message'=>"You are not allowed to be here!"]);
        }
    }


}