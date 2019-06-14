<?php

  # Permission
    if (!permission('posts', 'add')) {
        permission_page();
    }
  ## Permission ->

  # DB'de kategorinin var olup olmadığını kontrol et.
    $category_query = $db->from("categories")
                          ->orderby('category_name', 'ASC')
                          ->all();
  ## DB'de kategorinin var olup olmadığını kontrol et. ->

  # tagsInput

    # DB'den Tag'ları çekip tagArr[] dizisine aktardık

      $alltags = $db->from('tags')
                    ->orderby('tag_id', 'DESC')
                    ->all();

        $tagsArr = [];

        foreach ($alltags as $alltag) {

          $tagsArr[] = trim(htmlspecialchars($alltag['tag_name']));

        }

    ## DB'den Tag'ları çekip tagArr[] dizisine aktardık ->

  ## tagsInput ->

  # Submit Kısmı
    if (post('submit')) {

      $post_title = post('post_title');
      $post_content = post('post_content');
      $post_short_content = post('post_short_content');
      $post_categories = implode(',', post('post_categories'));
      $post_status = post('post_status');
      $post_seo = json_encode(post('post_seo'));
      $post_tags = post('post_tags');
      $post_url = permalink(post('post_url'));

      if (!$post_url) {
          $post_url = permalink($post_title);
      }

    }
  ## Submit Kısmı ->

  # Submit Kısmı
    if (post('submit')) {

        if (!$post_url || !$post_content || !$post_categories || !$post_status) {

            $error = 'Konu adı yada sayfa içerik alanı boş bırakılamaz.';

        } else {

          # DB'de konunun var olup olmadığını kontrol et.

            $query_posts = $db->from('posts')
                                ->where('post_url', $post_url)
                                ->first();

            # // Veritabanında üye kayıtlı mı Kontrolü

            if ($query_posts) {

                $error = $post_title . ' adlı konu bulunuyor. Lütfen başka bir sayfa adı yazıp tekrar deneyin.';
                header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);

            } else {

              $query_addpost = $db->insert('posts')
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
          
              if ($query_addpost) {

                  $postId = $db->lastId();

                  $post_tags = explode(",", $post_tags);

                  foreach ($post_tags as $tag) {

                    ## 'tags' DB'de etiketin var olup olmadığını kontrol et.

                      $query_tags = $db->from('tags')
                                      ->where('tag_url', permalink($tag))
                                      ->first();

                      if (!$query_tags) {

                          $tagInsert =  $db->insert('tags')
                                          ->set([
                                            'tag_name' => $tag,
                                            'tag_url' => permalink($tag)
                                          ]);

                          $tagId = $db->lastId();

                      } else {

                          $tagId = $query_tags['tag_id'];
                      }

                    ## 'tags' DB'de etiketin var olup olmadığını kontrol et. ->

                    # 'post_tags' DB'de konuya ait etiketin var olup olmadığını kontrol et. Yoksa EKLE

                      $query_post_tags = $db->from('post_tags')
                                            ->where('pt_post_id', $postId)
                                            ->where('pt_tag_id', $tagId)
                                            ->first();

                      if (!$query_post_tags) {

                          $tagInsert2 =  $db->insert('post_tags')
                                            ->set([
                                              'pt_post_id' => $postId,
                                              'pt_tag_id' => $tagId
                                            ]);

                          $tagId = $db->lastId();

                      } else {

                          $tagId = $query_tags['tag_id'];
                      }
                  
                    ## 'post_tags' DB'de konuya ait etiketin var olup olmadığını kontrol et. Yoksa EKLE ->

                  }

                  header('Location:' . admin_url('posts'));

              } else {

                  $error = $post_title . ' adlı konu eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
              }

            }

          ## DB'de konunun var olup olmadığını kontrol et. ->

        }
    }
  ## Submit Kısmı ->

require admin_view('add_post');
