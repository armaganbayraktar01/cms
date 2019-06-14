<?php

if (!permission('menus', 'edit')){
    permission_page();
}

$id = get('id');

if(!$id){
    header ('Location:', admin_url('menus'));
    exit;
}

$query_menus = $db->prepare('SELECT * FROM menus WHERE menu_id = :menu_id');
$result_menus = $query_menus->execute([
    'menu_id' => $id
]);

$row_menus = $query_menus->fetch(PDO::FETCH_ASSOC);

if(!$row_menus){
    header ('Location:', admin_url('menus'));
    exit;
}

    $json_menu_content = json_decode($row_menus['menu_content'], true);


if (post('submit')) {

    $menu = [];
    $menu_title = post('menu_title');

    if (!$menu_title) {
        $error = 'Menü başlığını belirtin.';
    } elseif (count(array_filter(post('title'))) == 0) {
        $error = 'En az bir menü içeriği girmeniz gerekiyor!';
    } else {

        $urls = post('url');
        foreach (post('title') as $key => $title) {
            $arr = [
                'title' => $title,
                'url' => $urls[$key]
            ];
            if (post('sub_title_' . $key)) {
                $submenu = [];
                $suburls = post('sub_url_' . $key);
                foreach (post('sub_title_' . $key) as $k => $subtitle) {
                    $submenu[] = [
                        'title' => $subtitle,
                        'url' => $suburls[$k]
                    ];
                }
                $arr['submenu'] = $submenu;
            }
            $menu[] = $arr;
        }

        // menüyü veritabanında güncelle
        $query_menu = $db->prepare('UPDATE menus SET menu_title = :menu_title, menu_content = :menu_content WHERE menu_id = :menu_id');
        $result_menu = $query_menu->execute([
            'menu_id' => $id,
            'menu_title' => $menu_title,
            'menu_content' => json_encode($menu,JSON_UNESCAPED_UNICODE)
        ]);

        if ($result_menu) {
            header('Location:' . admin_url('menus'));
        } else {
            $error = 'Bir sorun oluştu ve menü güncellenemedi!';
        }
    }

}

require admin_view('edit_menu');
?>