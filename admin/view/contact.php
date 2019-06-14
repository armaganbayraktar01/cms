<?php require admin_view('static/header'); ?>

    <div class="box-">
        <h1>
            İletişim Mesajları
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Durum</th>
                    <th>Adı Soyadı</th>
                    <th>E-mail Adresi</th>
                    <th>Telefonu</th>
                    <th>Konu</th>
                    <th>Mesaj</th>
                    <th class="hide">Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($query_contact as $row_contacts): ?>
                    <tr>
                        <td class="hide">
                            <?php if($row_contacts['contact_read'] == 1): ?>
                                <div style="font-size: 12px; background: green; text-align: center; color: #fff; padding: 3px 6px; border-radius: 3px">
                                    <strong><?=$row_contacts['user_name']?></strong> tarafından 
                                    <br>
                                    <?=timeConvert($row_contacts['contact_read_date'])?> okudu.
                                </div>
                            <?php else: ?>
                                <div style="background: darkred; text-align: center; color: #fff; padding: 3px 6px; border-radius: 3px">
                                    Okunmadı
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_contacts['contact_name']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_contacts['contact_email']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_contacts['contact_phone']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_contacts['contact_subject']?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$row_contacts['contact_message']?></a>
                        </td>                 
                        <td>
                            <span class="date"><?=timeConvert($row_contacts['contact_date'])?></span>
                        </td>
                        <td>
                            <?php if (permission('contact', 'edit')): ?>
                            <a href="<?= admin_url('edit_contact?id=' . $row_contacts['contact_id']) ?>" class="btn">Düzenle</a>
                            <?php endif; ?>
                            <?php if (permission('contact', 'delete')): ?>
                            <a href="<?= admin_url('delete?table=contact&column=contact_id&id=' . $row_contacts['contact_id']) ?>" class="btn">Sil</a>
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