<?php

$router->get('admin','PagesController@admin');
$router->get('image_load',function (){
    try {
        $response = FroalaEditor_Image::getList('/uploads/');
        echo stripslashes(json_encode($response));
    }
    catch (Exception $e) {
        http_response_code(404);
    }
});
$router->post('image_upload',function (){
    try {
        $response = FroalaEditor_Image::upload('/uploads/');
        echo stripslashes(json_encode($response));
    }
    catch (Exception $e) {
        http_response_code(404);
    }
});
$router->post('delete_image',function (){
    try {
        $response = FroalaEditor_Image::delete($_POST['src']);
        echo stripslashes(json_encode('Success'));
    }
    catch (Exception $e) {
        http_response_code(404);
    }

});
$router->post('upload_file',function (){
    try {
        $response = FroalaEditor_File::upload('/uploads/');
        echo stripslashes(json_encode($response));
    }
    catch (Exception $e) {
        http_response_code(404);
    }
});
$router->post('image_upload',function (){
    try {
        $response = FroalaEditor_Image::upload('/uploads/');
        echo stripslashes(json_encode($response));
    }
    catch (Exception $e) {
        $e->getMessage();
//         var_dump($response);
//         die();
//        http_response_code(404);
    }
});