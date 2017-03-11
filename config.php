<?php
return [
    'database'=>[
        'name'=>'lms',
        'username'=>'hanan',
        'password'=>'os37',
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
