<?php

// ana dizinin bulunduğu klasör
define('PATH', realpath('.'));
define('SUBFOLDER', true);
define('URL','http://localhost/cms');
define('SUBFOLDER_NAME', 'cms');

//veritabanı bağlantısı için dizi
return [
    'db' => [
        'name' => 'cms',
        'host' => 'localhost',
        'user' => 'root',
        'password' => ''
    ]
];


?>