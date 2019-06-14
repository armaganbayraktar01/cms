<?php

  # Permission

    if (!permission('pages', 'add')) {
        permission_page();
    }

  ## Permission ->

  # Submit Kısmı
    if (post('submit')) {

      $page_title = post('page_title');
      $page_content = post('page_content');
      $page_seo = json_encode(post('page_seo'));
      $page_url = permalink(post('page_url'));

      if (!$page_url) {
          $page_url = permalink($page_title);
      }

    }
  ## Submit Kısmı ->

  # Submit Kısmı
    if (post('submit')) {

        if (!$page_title || !$page_url || !$page_content) {

            $error = 'Sayfa adı yada sayfa içerik alanı boş bırakılamaz.';

        } else {

          # DB'de sayfanın var olup olmadığını kontrol et.

            $query_pages = $db->from('pages')
                              ->where('page_url', $page_url)
                              ->first();
            # Ekleme işlemi
              if ($query_pages) {

                  $error = $page_title . ' adlı sayfa zaten kullanılıyor. Lütfen başka bir sayfa adı yazıp tekrar deneyin.';
                  header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);

              } else {

                $query_addpage = $db->insert('pages')
                                    ->set([
                                        'page_title' => $page_title,
                                        'page_content' =>$page_content,
                                        'page_url' => permalink($page_title),
                                        'page_seo' => $page_seo
                                    ]);
          
                if ($query_addpage) {

                  header('Location:' . admin_url('pages'));

                } else {

                    $error = 'Sayfa eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
                }
              }
            ## Ekleme İşlemi ->

          ## DB'de kategorinin var olup olmadığını kontrol et. ->
        }
    }
  ## Submit Kısmı ->

require admin_view('add_page');
