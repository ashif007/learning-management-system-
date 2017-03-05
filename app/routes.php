<?php
$router->resource('users','UserController');
$router->get('admin','PagesController@admin');
$router->post('test',function ($request){
});
$router->get('test',function ($request){
   echo '<form action="/test" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>';
});
//Editor Api
$router->get('image_load','AjaxController@image_load');
$router->post('delete_image','AjaxController@delete_image');
$router->post('file_upload','AjaxController@file_upload');
$router->post('delete_file','AjaxController@delete_file');
$router->post('image_upload','AjaxController@image_upload');