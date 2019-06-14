<?php
if (!permission('categories', 'show')){
    permission_page();
}
/* Sayfalama kodu
    $totalRecord = $db->from('categories')
                    ->select('count(category_id) as total')
                    ->total();

        $pageLimit = 1;
        $pageParam = 'page';
        $pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);
*/

$query_categories = $db->from('categories')
                  ->orderby('category_order', 'ASC')
                  //->limit($pagination['start'], $pagination['limit'])
                  ->all();

require admin_view('categories');

?>