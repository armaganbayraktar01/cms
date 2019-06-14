<?php

if (!permission('contact', 'edit')) {
    permission_page();
}

$id = get('id');

if (!$id) {
    header('Location:', admin_url('contact'));
    exit;
}

$row_contacts = $db->from('contact')
                ->join('users', '%s.user_id = %s.contact_read_user', 'left')//ilk %s users tablosu ikincisi contact tablosu
                ->where('contact_id', $id)
                ->first();


if (!$row_contacts) {
    header('Location:', admin_url('contact'));
    exit;
}

if ($row_contacts['contact_read'] == 0) {
    $query_update_contact = $db->update('contact')
                               ->where('contact_id', $id)
                               ->set([
                                   'contact_read' => 1,
                                   'contact_read_date' => date('Y-m-d H:i:s'),
                                   'contact_read_user' => session('user_id'),
                               ]);
}

require admin_view('edit_contact');
