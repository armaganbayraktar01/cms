<?php

if (!permission('categories', 'edit')){
    permission_page();
}

$id = get('id');

if(!$id){
    header ('Location:', admin_url('categories'));
    exit;
}

if (post('submit')) {
    $category_name = post('category_name');
    $category_url = permalink(post('category_url'));
    //$category_template = post('category_template');
    if(!$category_url){
      $category_url = permalink($category_name);
    }
    $category_seo = json_encode(post('category_seo'));
}


$row_categories = $db->from('categories')
                ->where('category_id', $id)
                ->first();

if ( !$row_categories ){
    header ('Location:', admin_url('categories'));
    exit;
}


if (post('submit')) {

    if (!$category_name || !$category_url) {
        $error = 'Kategori adı boş bırakılamaz.';
    } else {
    
        # Veritabanında kategori kayıtlı mı Kontrolü 
    
        $query_categories = $db->from('categories')
                               ->where('category_id', $id, '!=')
                               ->where('category_url', $category_url)
                               ->first();
    
        # // Veritabanında üye kayıtlı mı Kontrolü 
    
        if ($query_categories) {
            $error = $category_name . ' adlı kategori zaten kullanılıyor. Lütfen başka bir kategori adı yazıp tekrar deneyin.';
            header('Refresh:2; url=' . $_SERVER['HTTP_REFERER']);
        } else {
    
            $query_update_category = $db->update('categories')
                                        ->where('category_id', $id)
                                        ->set([
                                            'category_name' => $category_name,
                                            'category_url' => permalink($category_name),
                                            'category_seo' => $category_seo
                                        ]);
            
            if ( $query_update_category ){
            header('Location:' . admin_url('categories'));
            } else {
                $error = 'Kategori eklenirken bir hata oluştu. Lütfen tekrar deneyin.';
            }
         }
    }
}

$category_seo = json_decode($row_categories['category_seo'], true);
require admin_view('edit_category');
?>