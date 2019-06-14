<?php

if (!permission('pages', 'edit')) {
    permission_page();
}

$id = get('id');

if (!$id) {
    header('Location:', admin_url('pages'));
    exit;
}

$row_pages = $db->from('pages')
                ->where('page_id', $id)
                ->first();

if (!$row_pages) {
    header('Location:', admin_url('pages'));
    exit;
}


if (post('submit')) {
    $page_title = post('page_title');
    $page_url = permalink(post('page_url'));
    //$category_template = post('category_template');
    if (!$page_url) {
        $page_url = permalink($page_title);
    }
    $page_content = post('page_content');
    $page_seo = json_encode(post('page_seo'));
}

if (post('submit')) {
    if (!$page_title || !$page_url || !$page_content) {
        $error = 'Sayfa adı  yada sayfa içerik alanı boş bırakılamaz.';
    } else {

    # Veritabanında sayfa kayıtlı mı Kontrolü

        $query_pages = $db->from('pages')
                           ->where('page_url', $page_url)
                           ->where('page_id', $id, '=!')
                           ->first();

        # // Veritabanında üye kayıtlı mı Kontrolü

        if ($query_pages) {
            $error = $page_title . ' adlı sayfa zaten kullanılıyor. Lütfen başka bir sayfa adı yazıp tekrar deneyin.';
            header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);
        } else {
            $query_updatepage = $db->update('pages')
                        ->where('page_id', $id)
                        ->set([
                            'page_title' => $page_title,
                            'page_content' => htmlspecialchars_decode($page_content),
                            'page_url' => permalink($page_title),
                            'page_seo' => $page_seo
                        ]);
      
            if ($query_updatepage) {
                header('Location:' . admin_url('pages'));
            } else {
                $error = 'Sayfa eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
            }
        }
    }
}

$row_seo = json_decode($row_pages['page_seo'], true);
require admin_view('edit_page');
