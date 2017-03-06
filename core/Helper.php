<?php
function public_dir(){
    return "/public/";
}
function view($view, $data = [])
{
    extract($data);
    return require "app/views/{$view}.view.php";
}
function partial($part, $data = [])
{
    extract($data);
    return require "app/views/partial/{$part}.part.php";
}
function redirect($url, $data=[], $statusCode = 303)
{
    \App\Core\Session::set('response' , $data);
    header('Location: ' . $url, true, $statusCode);
    die();
}
function asset($path)
{
    echo public_dir()."/$path";
}
function resource($type, $name)
{
    if ($type == 'css') {
        echo '<link rel="stylesheet" href="' . public_dir()."${type}/${name}.${type}" . '" >';
    } else if ($type == 'js') {
        echo '<script type="text/javascript" src="' . public_dir()."${type}/${name}.${type}" . '" ></script>';
    } else {
        return public_dir()."${type}/${name}.${type}";
    }
    return public_dir()."${type}/${name}.${type}";
}
function html_image($name,$option=['class'=>'','id'=>'']){
    echo '<img src="' . public_dir()."img/${name}" . '" class="'.$option['class'].'" id="'.$option['id'].'">';
}
function uploaded_image($name,$option=['class'=>'','id'=>'']){
    echo '<img src="' . "/uploads/${name}" . '" class="'.$option['class'].'" id="'.$option['id'].'">';
}
function html_link($url,$text,$option=['class'=>'','id'=>'']){
    echo '<a href="' .$url. '" class="'.$option['class'].'" id="'.$option['id'].'">'.$text."</a>";
}
function method_field($method)
{
    echo '<input type="hidden" name="_method" value=' . $method . ' />';
}
function start_form($method, $action, $option = ['class'=>''])
{
    if ($method === 'post' || $method === 'get') {
        echo '<form action="' . $action . '" method="' . $method . '"   enctype="multipart/form-data" >';
        csrf_field();
    } else {
        echo '<form action="' . $action . '" method="post" class="' . $option['class'].'">';
        method_field($method);
        csrf_field();
    }
}
function close_form()
{
    echo '</form>';
}
function generateCSRF()
{
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}
function verifyCSRF($request)
{
    if ($request->getCSRF()) {
        if (hash_equals($_SESSION['token'], $request->getCSRF())) {
            return true;
        } else {
            return false;
        }
    }
}
function csrf_field()
{
    echo '<input type="hidden" name="_token" value=' . generateCSRF() . ' />';
}
function getErrors()
{
    $errors = false;
    if (isset($_SESSION['response'])) {
        $response = $_SESSION['response'];
        unset($_SESSION['response']);
        if (isset($response['errors'])) {
            $errors = $response['errors'];
        }
    }
    return $errors;
}
function getResponse()
{
    $response = false;
    if (isset($_SESSION['response'])) {
        $response = $_SESSION['response'];
    }
    return $response;
}
function upload_file($fieldname)
{
    try {

        $response = \FroalaEditor\Utils\DiskManagement::upload('/uploads/',['fieldname' => "$fieldname"]);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
    return $response->link;
}
function delete_file($file)
{
    try {
        $response = \FroalaEditor\Utils\DiskManagement::delete($file);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}
function onFilesRemoveCallback($removed_files)
{
    foreach ($removed_files as $key => $value) {
        $file = '../uploads/' . $value;
        if (file_exists($file)) {
            unlink($file);
        }
    }
    return $removed_files;
}
function toJson($data)
{
    header('Access-Control-Allow-Origin: null');
    header('Content-Type: application/json');
    echo utf8_encode(json_encode($data));
}
function session_id_field(){
    echo '<input type = "hidden" name="PHPSESSID" value="'.session_id().'"/>';
}


function dispalyForDebug($data)
{
    if (gettype($data) == "array")
    {
        echo "<pre>".print_r($data,true)."</pre>";
    }
    else
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}