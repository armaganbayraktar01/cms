<?php

  # Permission
    if (!permission('posts', 'edit')) {
        permission_page();
    }
  ## Permission ->

  # Selectbox için kategorileri çektik
    $category_query = $db->from("categories")
                         ->orderby('category_name', 'ASC')
                         ->all();
  ## Selectbox için kategorileri çektik ->

  # Veritabanındaki POST'ları çekiyoruz

    $id = get('id');

    if (!$id) {

        header('Location:', admin_url('posts'));
        exit;
    }

    $query_posts = $db->from('posts')
                    ->where('post_id', $id)
                    ->first();

    if (!$query_posts) {

        header('Location:', admin_url('posts'));
        exit;

    }

  ## Veritabanındaki POST'ları çekiyoruz ->

  # TAGSINPUT - Etiketler

    // <- tags veritabanından Autocomplete de kullanılan etiketleri çekip listeleme kısmı

      $alltags = $db->from('tags')
      ->orderby('tag_id', 'DESC')
      ->all();

    //* tags veritabanından Autocomplete de kullanılan etiketleri çekip listeleme kısmı ->

    $tagsArr = [];
    foreach ($alltags as $alltag) {
        $tagsArr[] = trim(htmlspecialchars($alltag['tag_name']));
    }

    // <- POST_TAGS taki verileri $posttags[] dizisine aktarma

      $tags = $db->from('post_tags')
      ->join('tags', '%s.tag_id = %s.pt_tag_id ')
      ->where('pt_post_id', $id)
      ->all();


      $posttags = [];
      foreach ($tags as $tag) {
          $posttags[] = $tag['tag_name'];
      }

    //* POST_TAGS taki verileri $posttags[] dizisine aktarma ->

  ## TAGSINPUT - Etiketler ->

  # SUBMİT işlemi

    // <- POST_URL kontrolü

      if (post('submit')) {
          $post_title = post('post_title');
          $post_url = permalink(post('post_url'));

          if (!$post_url) {
              $post_url = permalink($post_title);
          }

          $post_content = post('post_content');
          $post_short_content = post('post_short_content');
          $post_categories = implode(',', post('post_categories'));
          $post_status = post('post_status');
          $post_seo = json_encode(post('post_seo'));
          $post_tags = post('post_tags');
      }

    //* POST_URL kontrolü ->

    // <- Boş alan kontrolü

      if (post('submit')) {
          if (!$post_url || !$post_content || !$post_categories || !$post_status) {
              $error = 'Konunun adı, konu içeriği, konunun ait olduğu kategori kısmı ya da konunun durumu boş bırakılamaz.';
          } else {

            // <-Veritabanında ilgili POST'u seçiyoruz

              $query_posts = $db->from('posts')
                                    ->where('post_url', $post_url)
                                    ->where('post_id', $id, '!=')
                                    ->first();

              if ($query_posts) {
                  $error = $post_title . ' adlı konu bulunuyor. Lütfen başka bir konu adı yazıp tekrar deneyin.';
                  header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);
              } else {
                  // <- UPDATE işlemi
                  $query_editpost = $db->update('posts')
                                      ->where('post_id', $id)
                                      ->set([
                                        'post_title' => $post_title,
                                        'post_content' => $post_content,
                                        'post_short_content' => $post_short_content,
                                        'post_categories' => $post_categories,
                                        'post_status' => $post_status,
                                        'post_url' => permalink($post_title),
                                        'post_tags' => $post_tags,
                                        'post_seo' => $post_seo
                                      ]);

                  // <- Etiketler veritabanında yok ise kayıt ediyoruz

                  if ($query_editpost) {
                      $postId = $id;


                      $post_tags = explode(",", $post_tags);

                      // <- TAGS Veritabanında etiketler kayıtlı mı kontrolü
                      foreach ($post_tags as $tag) {
                          $row_tags = $db->from('tags')
                                      ->where('tag_url', permalink($tag))
                                      ->first();

                          // <- Etiketler kayıtlı değil ise tags veritabanına kayıt ediyoruz. Kayıtlı ise son id alınıyor

                          if (!$row_tags) {
                              $tagInsert =  $db->insert('tags')
                                                ->set([
                                                  'tag_name' => $tag,
                                                  'tag_url' => permalink($tag)
                                                ]);

                              $tagId = $db->lastId();

                          } else {

                              $tagId = $row_tags['tag_id'];

                          }

                          // <- POST_TAGS Veritabanında etiketler kayıtlı mı kontrolü

                            $row_post_tag = $db->from('post_tags')
                                                ->where('pt_post_id', $postId)
                                                ->where('pt_tag_id', $tagId)
                                                ->first();
                              
                            // <- Etiketler kayıtlı değil ise post_tags veritabanına kayıt ediyoruz. Kayıtlı ise son id alınıyor
                              if (!$row_post_tag) {
                                  $tagInsert2 = $db->insert('post_tags')
                                                      ->set([
                                                        'pt_post_id' => $postId,
                                                        'pt_tag_id' => $tagId
                                                      ]);

                                  $tagId = $db->lastId();
                              } else {
                                  $tagId = $row_tags['tag_id'];
                              }
                            // Etiketler kayıtlı.. ->

                          //* POST_TAGS Veritabanında.. ->

                        //* Etiketler kayıtlı değil ise ->
                      }

                      // <- Silinen etiketlerin kontrolü ve güncellenmesi

                      $pt1 = trim($posttags); // virgüller hata verdiği için trim işlemi uygulandı
                      $pt2 = trim($post_tags);
                      $diffs = array_diff($pt1, $pt2); // post_tags veritabanındaki kayıt ile submitten sonra kalan tag lerin arasındaki farklı tagları bulduk
                      
                      if (count($diffs) > 0) {
                          foreach ($diffs as $diff) {
                              foreach ($allTags as $alltag) { // tags veritabanından çektiğimiz tag bilgileri
                                  if (trim($alltag['tag_name']) == $diff) {
                                      $db->delete('post_tags')
                                         ->where('tag_id', $alltag['tag_id'])
                                         ->done();
                                  }
                              }
                          }
                      }



                      header('Location:' . admin_url('posts'));
                  //* TAGS veritabanına.. ->
                  } else {
                      $error = 'Konu eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
                  }
                  //* Etiketler veritabanında yok ise kayıt ediyoruz ->
                //* UPDATE işlemi ->
              }
              //* Veritabanında ilgili POST'u seçiyoruz ->
          }
      }
    //* Boş alan kontrolü ->

  ## SUBMİT işlemi ->

  $row_seo = json_decode($query_posts['post_seo'], true);

  require admin_view('edit_post');
