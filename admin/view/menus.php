<?php require admin_view('static/header'); ?>


<div class="box-">
        <h1>
            Menu Yönetimi
            <?php if (permission('menus', 'add')): ?>
            <a href="<?= admin_url('add_menu') ?>">Menü Ekle</a>
            <?php endif; ?>
        </h1>
    </div>

    <div class="clear" style="height: 10px;"></div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Menü Başlığı</th>
                    <th class="hide">Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($row_menus as $row_menu): ?>
                    <tr>
                        <td class="hide">
                            <a href="#"><?=$row_menu['menu_title']?></a>
                        </td>
                        <td>
                            <span class="date"  title="<?=$row_menu['menu_date']?>"><?=timeConvert($row_menu['menu_date'])?></span>
                        </td>
                        <td>
                            <?php if (permission('menus', 'edit')): ?>
                            <a href="<?= admin_url('edit_menu?id=' . $row_menu['menu_id']) ?>" class="btn">Düzenle</a>
                            <?php endif; ?>
                            <?php if (permission('menus', 'delete')): ?>
                            <a href="<?= admin_url('delete?table=menus&column=menu_id&id=' . $row_menu['menu_id']) ?>" class="btn">Sil</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <?php require admin_view('static/footer'); ?>