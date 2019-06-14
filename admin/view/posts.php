<?php require admin_view('static/header'); ?>

    <div class="box-">
        <h1>
            Konu Yönetimi
            <?php if (permission('posts', 'add')): ?>
            <a href="<?= admin_url('add_post') ?>">Konu Ekle</a>
            <?php endif; ?>
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Konu Başlığı</th>
                    <th>URL</th>
                    <th>İçerik</th>
                    <th>Seo Title</th>
                    <th class="hide">Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($query_posts as $row_posts): ?>
                    <tr> 
                        <?php
                             $post_seo = json_decode($row_posts['post_seo'], true);            
                        ?>

                        <td class="hide">
                            <a href="#"><?=$row_posts['post_title']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_posts['post_url']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=cut_text($row_posts['post_content'])?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?= $post_seo['title'] ?></a>
                        </td>   
                        <td class="date" title="<?=$row_posts['post_date']?>">
                            <span class="date"><?=timeConvert($row_posts['post_date'])?></span>
                        </td>
                        <td>
                            <a href="<?= site_url('page/' . $row_posts['post_url']) ?>" class="btn" target="_blank">Görüntüle</a>
                            <?php if (permission('posts', 'edit')): ?>
                            <a href="<?= admin_url('edit_post?id=' . $row_posts['post_id']) ?>" class="btn">Düzenle</a>
                            <?php endif; ?>
                            <?php if (permission('posts', 'delete')): ?>
                            <a href="<?= admin_url('delete?table=posts&column=post_id&id=' . $row_posts['post_id']) ?>" class="btn">Sil</a>
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