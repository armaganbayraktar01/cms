<?php require admin_view('static/header'); ?>

    <div class="box-">
        <h1>
            Kategori Ekle
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
                            <label>Kategori Adı</label>
                            <div class="form-content">
                                <input type="text" name="category_name" value='<?=post('category_name')?>'>
                            </div>
                        </li>
                    </ul>
                </div>
                <div tab-content>     
                    <ul>
                        <li>
                            <label>SEO URL</label>
                            <div class="form-content">
                                <input type="text" name="category_url" value='<?=post('category_url')?>' placeholder='Boş bırakırsanız kategori adını baz alacaktır.'>
                            </div>
                        </li>
                        <li>
                            <label>SEO Title</label>
                            <div class="form-content">
                                <input type="text" name="category_seo[title]">
                            </div>
                        </li>

                        <li>
                            <label>SEO Description</label>
                            <div class="form-content">
                            <textarea class="editor" rows="4" cols="50" name="category_seo[description]"></textarea>
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