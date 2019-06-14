<?php

if (route(1) == 'kategori'){
    
    require controller('blog-category');

} else {

    if ($post_url =  route(1)) {

        require controller('blog-detail');

    } else {

    # Meta Bilgileri
        $meta = [
            'site_title' => settings('title'),
            'site_desc' => settings('description'),
            'site_keyw' => settings('keywords')
        ];
        
        ## Meta Bilgileri ->

        $totalRecord = $db->from('posts')
                      ->select('count(post_id) as total')
                      ->join('categories', 'FIND_IN_SET(categories.category_id, posts.post_categories)')
                      ->where('post_status', 1)
                      ->groupby('posts.post_id')
                      ->total();


        $pageLimit = 10;
        $pageParam = 'page';
        $pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

        $query_posts = $db->from('posts')
                      ->select('posts.*, GROUP_CONCAT(category_name SEPARATOR ", ") as category_name, GROUP_CONCAT(category_url SEPARATOR ", ") as category_url')
                      ->join('categories', 'FIND_IN_SET(categories.category_id, posts.post_categories)')
                      ->where('post_status', 1)
                      ->groupby('posts.post_id')
                      ->orderby('post_id', 'DESC')
                      ->limit($pagination['start'], $pagination['limit'])
                      ->all();

        require view('blog');
    }
}
