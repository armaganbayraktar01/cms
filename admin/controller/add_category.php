<?php

  # Permission
    if (!permission('categories', 'add')) {

        permission_page();

    }
  ## Permission ->

  # Submit kısmı
    if (post('submit')) {

      $category_name = post('category_name');
      $category_seo = json_encode(post('category_seo'));
      $category_url = permalink(post('category_url'));
      // $category_template = post('category_template');

      if (!$category_url) {

        $category_url = permalink($category_name);

      }

    }
  ## Submit kısmı ->

  # Submit kısmı
    if (post('submit')) {

        if (!$category_name || !$category_url) {

            $error = 'Kategorinin adı boş bırakılamaz.';

        } else {

        # DB'de kategorinin var olup olmadığını kontrol et.
          $query_categories = $db->from('categories')
                                  ->where('category_url', $category_url)
                                  ->first();
          
          if ($query_categories) {

              $error = $category_name . ' adlı kategori zaten kullanılıyor. Lütfen başka bir kategori adı yazıp tekrar deneyin.';
              header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);

          } else {

            # DB'de kategori kayıtlı değil ise insert işlemi yapıyoruz
              $query_addcategory = $db->insert('categories')
                                      ->set([
                                          'category_name' => $category_name,
                                          'category_url' => permalink($category_name),
                                          'category_seo' => $category_seo
                                      ]);
        
              if ($query_addcategory) {

                header('Location:' . admin_url('categories'));

              } else {

                $error = $category_name . 'adlı kategori eklenirken bir hata oluştu. Lütfen tekrar deneyin.';

              }
            ## DB'de kategori kayıtlı değil ise insert işlemi yapıyoruz ->

          }
        ## DB'de kategorinin var olup olmadığını kontrol et. ->
        }
    }
  ## Submit kısmı ->

require admin_view('add_category');
