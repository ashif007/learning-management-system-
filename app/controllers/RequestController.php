<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\ResourceInterface;
use App\Core\Session;
use App\Models\UserRequest;
use function partial;
use function redirect;
use function view;

/**
 * LMS by the forge team
 */

class RequestController extends Controller implements ResourceInterface {

	function index() {

		partial('admin/header');
		view('request/request');
		partial('admin/footer');
	}

	function send(Request $request) {
		$errors = $this->validator->validate($request, [
				'title'       => 'required|min:15',
				'description' => 'required|min:20',
			]);
		if ($errors) {
			$request->saveToSession($errors);
			redirect('/request', ['errors' => $request->getLastFromSession()]);
		} else {
			$user_request = new UserRequest();

			$user_request->title       = $request->get('title');
			$user_request->description = $request->get('description');
			print($user_request->description);
			print($user_request->title);
			$user_request->save();
			Session::set('message', "Your Request has been sent ");
			redirect('/request');
			// dispalyForDebug($request);
		}

	}
        
        //To list all user request to the admin
        function requset_list(){
            // check for the user role??
            $user_requests = UserRequest::all();            
            partial('admin/header');
            view('request/allrequests',['user_requests'=>$user_requests]);
            partial('admin/footer');            
        }
        
	function show($id) {
		
	}

    public function create() {
        
    }

    public function destroy($id) {
        
    }

    public function edit($id) {
        
    }

    public function store(Request $request) {
        
    }

    public function update(Request $request, $id) {
        
    }

}
