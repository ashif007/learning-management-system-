<?php
$router->resource('users','UserController');
$router->resource('courses', 'CoursesController');
$router->get('admin','PagesController@admin');
$router->resource('cats','CategoryController');

//Authentication routes
$router->get('login','AuthController@showlogin');
$router->get('register','AuthController@showregister');
$router->post('login','AuthController@login');
$router->post('logout','AuthController@login');
$router->post('register','AuthController@login');
//Editor Api
$router->get('image_load','AjaxController@image_load');
$router->post('delete_image','AjaxController@delete_image');
$router->post('file_upload','AjaxController@file_upload');
$router->post('delete_file','AjaxController@delete_file');
$router->post('image_upload','AjaxController@image_upload');
