<?php

    # Permission

        if (!permission('menus', 'add')) {

            permission_page();
        }

    ## Permission ->

    # Submit Kısmı
        if (post('submit')) {

            $menu = [];
            $menu_title = post('menu_title');

            if (!$menu_title) {

                $error = 'Lütfen menü başlığını belirtin.';

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

                ## DB'de menü kayıtlı değil ise insert işlemi yapıyoruz ->

                    $query_menu = $db->prepare('INSERT INTO menus SET menu_title = :menu_title, menu_content = :menu_content');
                    $result_menu = $query_menu->execute([
                                                    'menu_title' => $menu_title,
                                                    'menu_content' => json_encode($menu, JSON_UNESCAPED_UNICODE)
                                                ]);

                    if ($result_menu) {

                        header('Location:' . admin_url('menus'));

                    } else {
                        
                        $error = 'Bir sorun oluştu ve menü eklenemedi!';
                    }

                ## DB'de menü kayıtlı değil ise insert işlemi yapıyoruz ->
            }

        }
    ## Submit Kısmı ->

require admin_view('add_menu');