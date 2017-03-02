<?php
$router->get('admin','PagesController@admin');
$router->get('ajax_index',function (){
   $images=['public/img/avatar.png','public/img/avatar2.png','public/img/avatar3.png','public/img/avatar4.png'];
   toJson($images);
});
$router->post('ajax_upload',function (){

});