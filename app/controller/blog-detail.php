<?php

    $row_findpost = Blog::findPost($post_url);

    if (!$row_findpost) {
        header('Location:' . site_url('404'));
        exit;
    }

        # Meta Bilgileri

        $seo = json_decode($row_findpost['post_seo'], true);

        $meta = [
            'site_title' => $seo['title'] ? $seo['title'] : $row_findpost['post_title'],
            'site_desc' => $seo['description'] ? $seo['description'] : null
        ];
    
        ## Meta Bilgileri ->


    require view('blog-detail');