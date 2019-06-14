<?php

if (!permission('contact', 'show')){
    permission_page();
}

$totalRecord = $db->from('contact')
                  ->select('count(contact_id) as total')
                  ->total();

$pageLimit = 1;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$query_contact = $db->from('contact')
                  ->join('users', '%s.user_id = %s.contact_read_user', 'left')//ilk %s users tablosu ikincisi contact tablosu 
                  ->orderby('contact_id', 'DESC')
                  ->limit($pagination['start'], $pagination['limit'])
                  ->all();


require admin_view('contact');

?>