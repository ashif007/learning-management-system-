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
use App\Models\Course;

class CoursesController extends Controller implements ResourceInterface
{
    public function index()
    {
        $courses = Course::all();
        return view('admin/courses/index',['courses'=>$courses]);
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin/courses/create',['courses'=>$courses]);
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
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