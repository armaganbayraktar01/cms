<?php
if (!route(1)){
    $route[1] = 'index';
}

if (!file_exists(admin_controller(route(1)))){
    $route[1] = 'index';

}

if (!session('user_rank') || session('user_rank')== 3 ){
    $route[1] = 'login';
}

// <!--header.php => sidebar-->
$menus = [

    'index' => [
        'title' => 'Anasayfa',
        'icon' => 'tachometer-alt',
        'permissions' => [
            'show' => 'Görüntüleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]
    ],

    'menus' => [
        'title' => 'Menü Yönetimi',
        'icon' => 'bars',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]         
    ],

    'posts' => [
        'title' => 'Konu Yönetimi',
        'icon' => 'folder',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]         
    ],


    'categories' => [
        'title' => 'Kategori Yönetimi',
        'icon' => 'folder',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]         
    ],

    'pages' => [
        'title' => 'Sayfa Yönetimi',
        'icon' => 'file',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]         
    ],

    'contact' => [
        'title' => 'İletişim Mesajları',
        'icon' => 'envelope',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme',
            'send' => 'Cevaplama'
        ]         
    ],

    'users' => [
        'title' => 'Üyeler',
        'icon' => 'users',
        'permissions' => [
            'show' => 'Görüntüleme',
            'add' => 'Ekleme',
            'edit' => 'Düzenleme',
            'delete' => 'Silme'
        ]
     ],

    'settings' => [
        'title' => 'Ayarlar',
        'icon' => 'cog',
        'permissions' => [
            'show' => 'Görüntüleme',
            'edit' => 'Düzenleme'
        ]         
    ]

];

require admin_controller(route(1));

?>