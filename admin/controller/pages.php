<?php

if (!permission('pages', 'show')){
    permission_page();
}

$totalRecord = $db->from('pages')
                  ->select('count(page_id) as total')
                  ->total();

$pageLimit = 1;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$query_pages = $db->from('pages')
                    ->orderby('page_id', 'DESC')
                    ->limit($pagination['start'], $pagination['limit'])
                    ->all();


require admin_view('pages');

?>