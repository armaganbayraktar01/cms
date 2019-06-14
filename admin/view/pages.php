<?php require admin_view('static/header'); ?>

    <div class="box-">
        <h1>
            Sayfa Yönetimi
            <?php if (permission('pages', 'add')): ?>
            <a href="<?= admin_url('add_page') ?>">Sayfa Ekle</a>
            <?php endif; ?>
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Sayfa Başlığı</th>
                    <th>URL</th>
                    <th>İçerik</th>
                    <th>Seo Title</th>
                    <th class="hide">Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($query_pages as $row_pages): ?>
                    <tr> 
                        <?php
                             $page_seo = json_decode($row_pages['page_seo'], true);            
                        ?>

                        <td class="hide">
                            <a href="#"><?=$row_pages['page_title']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_pages['page_url']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=cut_text($row_pages['page_content'])?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?= $page_seo['title'] ?></a>
                        </td>   
                        <td class="date" title="<?=$row_pages['page_date']?>">
                            <span class="date"><?=timeConvert($row_pages['page_date'])?></span>
                        </td>
                        <td>
                            <a href="<?= site_url('page/' . $row_pages['page_url']) ?>" class="btn" target="_blank">Görüntüle</a>
                            <?php if (permission('pages', 'edit')): ?>
                            <a href="<?= admin_url('edit_page?id=' . $row_pages['page_id']) ?>" class="btn">Düzenle</a>
                            <?php endif; ?>
                            <?php if (permission('pages', 'delete')): ?>
                            <a href="<?= admin_url('delete?table=pages&column=page_id&id=' . $row_pages['page_id']) ?>" class="btn">Sil</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <div class="pagination">
            <ul><?php echo $db->showPagination(admin_url(route(1)) . '?'.$pageParam.'=[page]'); ?></ul>
        </div>
    </div>
        
<?php require admin_view('static/footer'); ?>