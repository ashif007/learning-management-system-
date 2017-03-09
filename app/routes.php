<?php
$router->resource('users', 'UserController');
$router->resource('courses', 'CoursesController');
$router->resource('cats', 'CategoryController');
$router->resource('requests', 'RequestController');
$router->resource('comments', 'CommentController');
//Pages routes
$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('admin', 'PagesController@admin');

//Authentication routes
$router->get('login', 'AuthController@showlogin');
$router->get('register', 'AuthController@showregister');
$router->post('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');
$router->post('register', 'AuthController@login');
//Editor Api
$router->get('image_load', 'AjaxController@image_load');
$router->post('delete_image', 'AjaxController@delete_image');
$router->post('file_upload', 'AjaxController@file_upload');
$router->post('delete_file', 'AjaxController@delete_file');
$router->post('image_upload', 'AjaxController@image_upload');
$router->post('request/send', 'RequestController@send');