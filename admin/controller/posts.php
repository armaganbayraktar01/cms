<?php

if (!permission('posts', 'show')){
    permission_page();
}

$totalRecord = $db->from('posts')
                  ->select('count(post_id) as total')
                  ->total();

$pageLimit = 1;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$query_posts = $db->from('posts')
                    ->orderby('post_id', 'DESC')
                    ->limit($pagination['start'], $pagination['limit'])
                    ->all();


require admin_view('posts');

?>