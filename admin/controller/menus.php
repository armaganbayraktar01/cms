<?php

if (!permission('menus', 'show')){
    permission_page();
}

/*
$query_menus = $db->prepare('SELECT * FROM menus ORDER BY menu_id DESC');
$result_menus = $query_menus->execute();

$row_menus = $query_menus->fetchAll(PDO::FETCH_ASSOC);

*/

$row_menus = $db->from('menus')
                ->orderby('menu_id', 'DESC')
                ->all();


require admin_view('menus');
?>