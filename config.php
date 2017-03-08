<?php
return [
    'database'=>[
<<<<<<< HEAD
        'name'=>'lms',
        'username'=>'root',
        'password'=>'root',
=======
        'name'=>'salamadb',
        'username'=>'root',
        'password'=>'terminator',
>>>>>>> a38694d0cd1c570657d112d7444f72d83358c5c2
        'connection'=>'mysql:host=localhost;',
        'options'=>[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ]
    ]
    ,
    'heroku'=>false
    ,
    'rss'=>[
        "title" => "salama.com",
        "link" => "http://www.salamablog.com",
        "description" => "Salama blog",
        "language" => "en",  // optional
        "image_title" => "http://www.salamablog.com", // optional
        "image_link" => "http://www.salamablog.com", // optional
        "image_url" => "http://www.salamablog.com" // optional
    ]
];
