<?php require admin_view('static/header'); ?>

<div class="box-">
    <h1>
        Kategoriler
        <?php if (permission('categories', 'add')): ?>
        <a href="<?= admin_url('add_category') ?>">Kategori Ekle</a>
        <?php endif; ?>

    </h1>
</div>

<div class="clear" style="height: 10px;"></div>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>Kategori adı</th>
                <th>Kategori URL</th>
                <th>Seo Title</th>
                <th>Seo Description</th>
                <th>Kategori Template</th>
                <th class="hide">Eklenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody class="table-sortable" data-table="categories" data-where="category_id" data-column="category_order">

            <?php foreach($query_categories as $row_categories): ?>
                <tr id="id_<?=$row_categories['category_id']?>">
                    <?php
                         $category_seo = json_decode($row_categories['category_seo'], true);            
                    ?>
                
                   <td class="hide">
                        <a href="#"><?=$row_categories['category_name']?></a>
                    </td>
                    <td class="hide">
                        <a href="#"><?=$row_categories['category_url']?></a>
                    </td>
                    <td class="hide">
                        <a href="#"><?= $category_seo['title'] ?></a>
                    </td>
                    <td class="hide">
                        <a href="#"><?= $category_seo['description'] ?></a>
                    </td>
                    <td class="hide">
                        <a href="#"><?=$row_categories['category_template']?></a>
                    </td>                     
                    <td>
                        <span  title="<?=$row_categories['category_date']?>" class="date"><?=timeConvert($row_categories['category_date'])?></span>
                    </td>
                    <td>
                        <?php if (permission('categories', 'edit')): ?>
                        <a href="<?= admin_url('edit_category?id=' . $row_categories['category_id']) ?>" class="btn">Düzenle</a>
                        <?php endif; ?>
                        <?php if (permission('categories', 'delete')): ?>
                        <a href="<?= admin_url('delete?table=categories&column=category_id&id=' . $row_categories['category_id']) ?>" class="btn">Sil</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>

        
<?php require admin_view('static/footer'); ?>