<?php require admin_view('static/header'); ?>

<div class="box-">
    <h1>
        Konu Ekle
    </h1>
</div>

<div class="clear" style="height: 10px;"></div>

<div class="box-" tab>

    <div class="admin-tab">
        <ul tab-list>
            <li>
                <a href="#">Genel</a>
            </li>
            <li>
                <a href="#">SEO</a>
            </li>
        </ul>
    </div>

    <form action="" method="post" class="form label">
        <div class="tab-container">
            <div tab-content>
                <ul>
                    <li>
                        <label>Konu Adı</label>
                        <div class="form-content">
                            <input type="text" name="post_title" value='<?=post('post_title')?>'>
                        </div>
                    </li>
                    <li>
                        <label>Konu İçeriği</label>
                        <div class="form-content">
                            <textarea name="post_content" class="editor" id="" cols="30"
                                rows="10"><?=post('post_content')?></textarea>
                        </div>
                    </li>
                    <li>
                        <label>Konu İçeriği (Kısa)</label>
                        <div class="form-content">
                            <textarea name="post_short_content" class="editor" id="" cols="30"
                                rows="4 "><?=post('post_short_content')?></textarea>
                        </div>
                    </li>
                    <li>
                        <label>Konu Kategorisi</label>
                        <div class="form-content">
                            <select name="post_categories[]" multiple size="6">
                                <?php foreach($category_query as $category_row):?>
                                <option value="<?=$category_row['category_id']?>"><?=$category_row['category_name']?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <label>Konu Durumu</label>
                        <div class="form-content">
                            <select name="post_status">
                                <option value="1" <?=post('post_status') == 1 ? ' selected' : null?>>Yayında</option>
                                <option value="2"<?=post('post_status') == 2 ? ' selected' : null?>>Taslak</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <label>Konu Etiketleri</label>
                        <div class="form-content">
                            <input type="text" class="tagsinput" name="post_tags" value="<?=post('post_tags')?>">
                        </div>
                    </li>

                </ul>
            </div>
            <div tab-content>
                <ul>
                    <li>
                        <label>SEO URL</label>
                        <div class="form-content">
                            <input type="text" name="post_url" value='<?=post('post_url')?>'
                                placeholder='Boş bırakırsanız Konu adını baz alacaktır.'>
                        </div>
                    </li>
                    <li>
                        <label>SEO Title</label>
                        <div class="form-content">
                            <input type="text" name="post_seo[title]">
                        </div>
                    </li>

                    <li>
                        <label>SEO Description</label>
                        <div class="form-content">
                            <textarea rows="4" cols="50" name="post_seo[description]" class="editor"></textarea>
                        </div>
                    </li>
                </ul>
            </div>
            <ul>
                <li class="submit">
                    <input type="hidden" name="submit" value="1">
                    <button type="submit">Gönder</button>
                </li>
            </ul>
        </div>
    </form>
</div>

<script>
var tags = ['<?=implode("','" ,$tagsArr)?>'];
</script>

<?php require admin_view('static/footer'); ?>