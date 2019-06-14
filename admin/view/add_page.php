<?php require admin_view('static/header'); ?>

    <div class="box-">
        <h1>
            Sayfa Ekle
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
                            <label>Sayfa Adı</label>
                            <div class="form-content">
                                <input type="text" name="page_title" value='<?=post('page_title')?>'>
                            </div>
                        </li>
                        <li>
                            <label>Sayfa İçeriği</label>
                            <div class="form-content">
                                <textarea name="page_content" class="editor" id="" cols="30" rows="10"><?=post('page_content')?></textarea>
                            </div>
                        </li>
                    </ul>
                </div>
                <div tab-content>     
                    <ul>
                        <li>
                            <label>SEO URL</label>
                            <div class="form-content">
                                <input type="text" name="page_url" value='<?=post('page_url')?>' placeholder='Boş bırakırsanız Sayfa adını baz alacaktır.'>
                            </div>
                        </li>
                        <li>
                            <label>SEO Title</label>
                            <div class="form-content">
                                <input type="text" name="page_seo[title]">
                            </div>
                        </li>

                        <li>
                            <label>SEO Description</label>
                            <div class="form-content">
                            <textarea rows="4" cols="50" name="page_seo[description]" class="editor"></textarea>
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

<?php require admin_view('static/footer'); ?>